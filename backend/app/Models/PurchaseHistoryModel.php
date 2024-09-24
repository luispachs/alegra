<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseHistoryModel extends Model
{
    use HasFactory;

    protected $table ="purchase_history";
    public $timestamps = false;


    public function ingredient():HasOne
    {
        return $this->hasOne(IngredientModel::class,'id','ingredient_id');
    }
}
