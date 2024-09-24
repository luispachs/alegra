<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RecipeModel extends Model
{
    use HasFactory;
    protected $table ="recipes";
    public $timestamps = false;


    public function ingredients():BelongsToMany{
        return $this->belongsToMany(IngredientModel::class,'recipes_ingredients','recipe_id','ingredient_id')->withPivot('amount');
    }
}
