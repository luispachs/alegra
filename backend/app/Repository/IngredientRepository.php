<?php

namespace App\Repository;

use App\AWS\Messages\SqsMessage;
use App\AWS\SQS;
use App\Models\IngredientModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use stdClass;

class IngredientRepository implements RepositoryInterface{
    private SQS $sqs;
    private array $config;
    public function __construct()
    {
        $this->sqs = new SQS();
    }
    public function getById(int $id,bool $useCache=true):stdClass|Model|null
    {
        throw new \Exception('This method has been implemented');

    }
    public function getAll(bool $useCache=true):Collection
    {
        $key = "GetAllIngredients";

        if(Cache::has($key) && $useCache){
            return Cache::get($key);
        }


        $ingredients = IngredientModel::all();

        Cache::put($key,$ingredients,300);
        return $ingredients;
    }
    public function create(Array $data):stdClass|Model|null
    {
        throw new \Exception('This method has been implemented');

    }
    public function update(int $id, Array $data):stdClass|Model|null
    {
        throw new \Exception('This method has been implemented');

    }
    public function delete(int $id):bool
    {
        throw new \Exception('This method has been implemented');

    }


    public function discountAmount(int $id, int $amount=0)
    {
        $ingredient = IngredientModel::find($id);
        $field = [];
        if($ingredient->unit_available - $amount < 0){
            $message = new SqsMessage();

            $message = $message->getMessage('SQS_PURCHASE_QUEUE', $ingredient ,md5($ingredient->id.'-'.$ingredient->name),md5($ingredient->id."-".str_replace(' ','-',$ingredient->name)));
            $this->sqs->sendMessage($message);
            throw new \Exception('Unit not available');
        }

        if($ingredient->unit_available - $amount == 0){
            $field['is_avilable'] = false;
        }

        $field['unit_available'] = $ingredient->unit_available - $amount;
        DB::table('ingredients')->where('id','=',$id)->update($field);

        return $ingredient;
    }

    public function updateAmount(int $id,int $amount)
    {   
        $fields =[];
        $ingredient = DB::table('ingredients')->find($id);
        $fields['unit_available'] = $ingredient->unit_available + $amount;
        $fields['is_avilable'] =true;
        $ingredient = DB::table('ingredients')->where('id','=',$id)->update($fields);
        return $ingredient;
    }
}