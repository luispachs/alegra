<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use \stdClass;
use Illuminate\Support\Facades\{Cache,DB};
class UserRepository implements RepositoryInterface{

    public function getById(int $id, bool $useCache = true):stdClass|Model|null
    {
        throw new \Exception('This function require implementation');
        
    }
    public function getByEmail(string $email, bool $useCache = true): stdClass|Model|null
    {
        $key = "GetUserByEmail_$email";
        if($useCache && Cache::has($key)){
            return Cache::get($key);
        }

        $user = DB::table('users')->where('email','=',$email)->first();

        Cache::put($key,$user,300);

        return $user;
    }
    public function getAll(bool $useCache=true):Collection{

        $key = "GetAllUser";
        if($useCache && Cache::has($key)){
            return Cache::get($key);
        }

        $users = User::all();
        Cache::put($key,$users,300);

        return $users;
    }
    public function create(Array $data):stdClass|Model|null
    {

        $user = new User();
        $user->save();
        return $user;
    }
    public function update(int $id, Array $data):stdClass|Model|null
    {
        throw new \Exception('This function require implementation');
    }
    public function delete(int $id):bool{

        throw new \Exception('This function require implementation');
    }
}