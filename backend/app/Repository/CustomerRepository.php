<?php


namespace App\Repository;

use App\Models\CustomerModel;
use Illuminate\Support\Facades\Cache;
use \stdClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CustomerRepository implements RepositoryInterface{

    public function getById(int $id,bool $useCache=true):stdClass|Model|null{
        throw new \Exception('This method has been implemented');


    }
    public function getAll(bool $useCache=true):Collection {
        throw new \Exception('This method has been implemented');


    }
    public function create(Array $data):stdClass|Model|null{
        extract($data);
        $customer = new CustomerModel();
        $customer->firstname=$firstname;
        $customer->last_name=$lastname;
        $customer->middle_name=$middlename;
        $customer->email=$email;
        $customer->save();

        return $customer;
    }
    public function update(int $id, Array $data):stdClass|Model|null{
        throw new \Exception('This method has been implemented');

    }
    public function delete(int $id):bool{
        throw new \Exception('This method has been implemented');
    }

    public function getByEmail(string $email,bool $useCache=true){
        $key = "GetCustomerByEmail_$email";

        if($useCache && Cache::has($key)){
            return Cache::get($key);
        }

        $customer = CustomerModel::where('email','=',$email)->first();
        Cache::put($key,$customer,300);

        return $customer;
    }
    
}