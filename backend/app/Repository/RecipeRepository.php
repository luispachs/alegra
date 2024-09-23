<?php

namespace  App\Repository;

use App\Models\RecipeModel;
use Illuminate\Support\Facades\Cache;
use \stdClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;



class RecipeRepository implements RepositoryInterface{

    public function getById(int $id,bool $useCache=true):stdClass|Model|null
    {
        $key = "GetRecipeById_$id";
        if($useCache && Cache::has($key)){
            return Cache::get($key);
        }

        $recipe = RecipeModel::find($id);

        Cache::put($key,$recipe,600);
        return $recipe;

    }

    public function getAll(bool $useCache=true):Collection 
    {
        throw new \Exception('This method has been implemented');

    }

    public function create(Array $data):stdClass|Model|null
    {
        extract($data);
        $recipe = new RecipeModel();


        return $recipe;
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