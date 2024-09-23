<?php

namespace App\Http\Controllers;

use App\AWS\Messages\SqsMessage;
use App\AWS\SQS;
use App\Models\OrdenModel;
use App\Repository\CustomerRepository;
use App\Repository\OrdenRepository;
use App\Repository\RecipeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class OrdenController extends Controller
{
    public function set(Request $request,RecipeRepository $recipeRepository,CustomerRepository $customerRepository,OrdenRepository $ordenRepository,SQS $sqs,SqsMessage $message):JsonResponse
    {   
        try{
            $firstname = $request->get('firstname');
        $middlename = $request->get('middlename');
        $lastname = $request->get('lastname');
        $email = $request->get('email');

        $customer = $customerRepository->getByEmail($email);
        if($customer==null){
            $customer = $customerRepository->create(['firstname'=>$firstname,'lastname'=>$lastname,'middlename'=> $middlename,'email'=> $email]);
        }

        if($customer->orders()->get()->count()>0){
            return response()->json(['message'=>__('user_has_a_order')],400);
        }
        $recipe = $recipeRepository->getById(random_int(1000,1005));

        $order = $ordenRepository->create(['customer_id'=>$customer->id,'recipe_id'=>$recipe->id]);
        $message = $message->getMessage('SQS_ORDEN_QUEUE', $order,md5($customer->email."-".$order->id),md5($customer->email."-".str_replace(' ','-',$recipe->name)));
        $sqs->sendMessage($message);

        return response()->json([
        'status'=>'done',
        'product'=>[
            'id'=>$recipe->id,
            'name'=> $recipe->name
            ],
        'order'=> $order->id
        ]);

        }catch(\Exception $e){
            Log::error($e->getMessage(),['trace'=>$e->getTraceAsString()]);
            return response()->json(['message'=>__('general_exception')],400);
        }
    }

    public function getAll(Request $request,OrdenRepository $ordenRepository):JsonResponse
    {   
        try{
            
            $ordens = $ordenRepository->GetAllOrdensDB()->toArray();
            return response()->json(['ordens'=>$ordens],200);
        }catch(\Exception $e){
            return response()->json(['message'=>__('general_exception')],500);
        }
    }
}
