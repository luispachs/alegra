<?php

namespace App\Jobs;

use App\AWS\SQS;
use App\Models\IngredientModel;
use App\Models\PurchaseHistoryModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Repository\{IngredientRepository,PurchaseHistoryRepository};
use Illuminate\Support\Facades\DB;

class ProcessPurchase implements ShouldQueue
{
    use Queueable;
    private array $config;
    private SQS $sqs;
    const  MARKETURL = "https://recruitment.alegra.com/api/farmers-market/buy";
    private string $recieptHandle;
    private IngredientRepository $ingredientRepository;
    private PurchaseHistoryRepository $purchaseHistory;

  
    public function __construct()
    {
        $this->config = $this->config =[
            'MaxNumberOfMessages' =>1,
            'MessageAttributeNames' =>['All'],
            'QueueUrl' => env('SQS_PURCHASE_QUEUE'),
            'WaitTimeSeconds'=>1
        ];
        $this->sqs = new SQS();
        $this->ingredientRepository = new IngredientRepository();
        $this->purchaseHistory = new PurchaseHistoryRepository();
    }

 
    public function handle(): void
    {
        try{
            $message = $this->sqs->getMessage($this->config);            
            if(!empty($message)){
           
            $this->recieptHandle = $message[0]['ReceiptHandle'];
            print_r($this->recieptHandle);

                $ingredient = new IngredientModel();
                $ingredient->unserialize($message[0]['Body']);
                $amount = $this->getProductInventory($ingredient->name);
                if($amount != 0){
                    DB::beginTransaction();
                    $this->ingredientRepository->updateAmount($ingredient->id,$amount);
                    $this->purchaseHistory->create(['ingredient'=>$ingredient->id,'amount'=>$amount]);
                    DB::commit();
                }

                $this->sqs->deleteMessage('SQS_PURCHASE_QUEUE',$this->recieptHandle);
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(),['trace'=> $e->getTraceAsString()]);
            DB::rollBack();
        }

    }

    public function getProductInventory(string $productName): int{
        $response = Http::get(self::MARKETURL,['ingredient'=>$productName]);
        return (int) $response->json("quantitySold",0);

    }
}
