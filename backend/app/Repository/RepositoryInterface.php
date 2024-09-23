<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface RepositoryInterface{
    public function getById(int $id,bool $useCache=true):stdClass|Model|null;
    public function getAll(bool $useCache=true):Collection;
    public function create(Array $data):stdClass|Model|null;
    public function update(int $id, Array $data):stdClass|Model|null;
    public function delete(int $id):bool;
}   