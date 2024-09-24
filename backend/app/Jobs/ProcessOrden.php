<?php

namespace App\Jobs;

use App\AWS\SQS;
use App\Enum\OrdenStatusEnum;
use App\Models\OrdenModel;
use App\Repository\IngredientRepository;
use App\Repository\OrdenRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\{Log,DB};
use App\Repository\RecipeRepository;

class ProcessOrden implements ShouldQueue
{
    use Queueable;

    private array $config;
    private SQS $sqs;
    private string $recieptHandle;
    private RecipeRepository $recipeRepository;
    private OrdenRepository $ordenRepository;
    private IngredientRepository $ingredientRepository;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->config =[
            'MaxNumberOfMessages' =>1,
            'MessageAttributeNames' =>['All'],
            'QueueUrl' => env('SQS_ORDEN_QUEUE'),
            'WaitTimeSeconds'=>1
        ];


        $this->sqs = new Sqs();
        $this->recipeRepository = new RecipeRepository();
        $this->ordenRepository = new OrdenRepository();
        $this->ingredientRepository = new IngredientRepository();

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       try{
        $message = $this->sqs->getMessage($this->config);
        if(!empty($message)){       
            $this->recieptHandle = $message[0]['ReceiptHandle'];
            $orden = new OrdenModel();
            $orden->unserialize($message[0]['Body']);
            if($orden->status == OrdenStatusEnum::REQUESTED->value){
                $this->ordenRepository->changeStatus($orden->id,OrdenStatusEnum::IN_PROCESS);
            }
            $recipe = $this->recipeRepository->getById($orden->recipe);
            $ingredients = $recipe->ingredients()->get();
            DB::beginTransaction();
            foreach($ingredients as $ingredient){
                $this->ingredientRepository->discountAmount((int) $ingredient->id,( int ) $ingredient->pivot->amount);
            }
            $this->ordenRepository->changeStatus($orden->id,OrdenStatusEnum::DELIVERED);

            DB::commit();

            $this->sqs->deleteMessage('SQS_ORDEN_QUEUE',$this->recieptHandle);

        }
       }catch(\Exception $e){
        Log::error($e->getMessage(),['trace' =>$e->getTraceAsString()]);
        DB::rollBack();
       }
    }


}
