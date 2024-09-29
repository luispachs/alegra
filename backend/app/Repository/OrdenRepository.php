<?php


namespace App\Repository;

use App\Enum\OrdenStatusEnum;
use App\Models\CustomerModel;
use App\Models\OrdenModel;
use App\Models\RecipeModel;
use \stdClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as DbCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Cache,DB};

class OrdenRepository implements RepositoryInterface{

    public function getById(int $id,bool $useCache=true):stdClass|Model|null
    {
        throw new \Exception('This method has been implemented');


    }
    public function getAll(bool $useCache=true):Collection 
    {
            $key = "GetAllOrdens";
            if($useCache && Cache::get($key)){
                return Cache::get($key);
            }
          
            $ordens = OrdenModel::select('customers.id as customer,recipes.recipe as recipe, ordens.status as status,customers.firstname as firstname, customers.middle_name as middlename, customers.last_name as lastname, customers.email as email,recipes.name as name, ordens.id as orden, recipes.duration as duration,recipes.temperature as temperature')
                                ->join('customers','customers.id','=','ordens.customer')
                                ->join('recipes','recipes.id','=','ordens.recipe')->get();
            Cache::put($key,$ordens,300);
            return $ordens;
    }
    public function create(Array $data):stdClass|Model|null
    {
        extract($data);
        $order = new OrdenModel();
        $order->customer = $customer_id;
        $order->recipe = $recipe_id;
        $order->status = 'REQUESTED';
        $order->save();

        Cache::forget("GetAllOrdens");    
        Cache::forget("GetAllOrdensDB");    
        return $order;
    }
    public function update(int $id, Array $data):stdClass|Model|null
    {
        throw new \Exception('This method has been implemented');

    }
    public function delete(int $id):bool
    {
        throw new \Exception('This method has been implemented');
    }

    public function GetAllOrdensDB (bool $useCache=true):DbCollection 
    {
            $key = "GetAllOrdensDB";
            if($useCache && Cache::get($key)){
                return Cache::get($key);
            }
      
            $ordens = DB::table('ordens')
                                ->select(['customers.id as customer','recipes.recipe as recipe', 'ordens.status as status','customers.firstname as firstname', 'customers.middle_name as middlename', 'customers.last_name as lastname', 'customers.email as email','recipes.name as name', 'ordens.id as ordenId', 'recipes.duration as duration','recipes.temperature as temperature'])
                                ->join('customers','customers.id','=','ordens.customer')
                                ->join('recipes','recipes.id','=','ordens.recipe')->orderBy('ordens.id','desc')->get();
            Cache::put($key,$ordens,300);
            return $ordens;
    }

    public function changeStatus(int $id,OrdenStatusEnum $status){
      
        $result = DB::table('ordens')->where('id','=',$id)->update(['status' =>$status->value]) ;
    
        return $result;
    }


    

}