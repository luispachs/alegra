<?php

namespace App\Repository;

use App\Models\IngredientModel;
use App\Models\PurchaseHistoryModel;
use Illuminate\Support\Facades\Cache;
use \stdClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PurchaseHistoryRepository implements RepositoryInterface{
    public function getById(int $id,bool $useCache=true):stdClass|Model|null
    {
        throw new \Exception('This method has been implemented');

    }
    public function getAll(bool $useCache=true):Collection
    {
        $key = "GetAllPurchase";

        if($useCache && Cache::has($key)){
            return Cache::get($key);
        }

        $purchaseHistory = PurchaseHistoryModel::all();

        Cache::put($key,$purchaseHistory,300);
        return $purchaseHistory;

    }
    public function create(Array $data):stdClass|Model|null
    {   
        extract($data);
        $date =new \DateTime('now');
        $purchaseHistory = new PurchaseHistoryModel();
        $purchaseHistory->ingredient_id = $ingredient;
        $purchaseHistory->amount = $amount;
        $purchaseHistory->creation_date = $date->format('Y-m-d H:i:s');
        $purchaseHistory->save();
        return $purchaseHistory;

    }
    public function update(int $id, Array $data):stdClass|Model|null
    {
        throw new \Exception('This method has been implemented');

    }
    public function delete(int $id):bool
    {
        throw new \Exception('This method has been implemented');

    }
}