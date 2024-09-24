<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Serializable;

class IngredientModel extends Model implements Serializable
{
    use HasFactory;
    protected $table ="ingredients";
    public $timestamps = false;

    public function serialize()
    {
        return json_encode(
            [
                "id" => $this->id,
                "name"=> $this->name,
                "unit_available"=>$this->unit_available,
                "is_avilable"=>$this->is_avilable
            ]
        );
    }

    public function unserialize(string $data)
    {   $content = json_decode($data,true);
        $this->id = $content['id'];
        $this->name = $content['name'];
        $this->unit_available = $content['unit_available'];
        $this->is_avilable = $content['is_avilable'];
    }
}
