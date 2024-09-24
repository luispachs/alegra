<?php

namespace App\Http\Controllers;

use App\Repository\PurchaseHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WarehouseController
{
    
    public function index(Request $request,PurchaseHistoryRepository $purchaseHistoryRepository){

        try{
            $purchaseHistory = $purchaseHistoryRepository->getAll();
            $data =[];
            foreach($purchaseHistory as $item){
                $ingredient = $item->ingredient()->first();
                $purchase = ['id'=>$item->id,'ingredient_id'=>$item->ingredient_id,'created_at' => $item->creation_date,'name'=>$ingredient->name,'amount'=> $item->amount,'is_available'=> $ingredient->is_avilable];
                $data[] = $purchase;
            };
            
            return response()->json(["data" => $data],200);
        }catch(\Exception $e){
            Log::error($e->getMessage(),['trace'=>$e->getTraceAsString()]);
            return response()->json(["message" => __('general_exception')],500);
        }

    }
}
