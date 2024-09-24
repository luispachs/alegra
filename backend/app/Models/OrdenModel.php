<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrdenModel extends Model implements \Serializable
{
    use HasFactory;
    protected $table ="ordens";
    public $timestamps = false;
    protected $fillable =['status'];

    public function customer():HasOne{
        return $this->hasOne(CustomerModel::class,'id','customer');
    }

    public function serialize()
    {
        return json_encode(
            [
                "id" => $this->id,
                "customer"=> $this->customer,
                "recipe"=>$this->recipe,
                "status"=>$this->status
            ]
        );
    }

    public function unserialize(string $data)
    {   $content = json_decode($data,true);
        $this->id = $content['id'];
        $this->customer = $content['customer'];
        $this->recipe = $content['recipe'];
        $this->status = $content['status'];

    }
}
