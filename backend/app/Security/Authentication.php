<?php 

namespace App\Security;

use DateInterval;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use \stdClass;

class Authentication{
    const string hash = 'HS512';
    public static function jwt(string $email,int $id):string{

        $creationDate = new \DateTime('now');
        $expiration = new \DateTime('now');
        $expiration->add(DateInterval::createFromDateString('8 hours'));
        $payload =[
            'iss' => env('APP_URL'),
            'aud' => env('APP_URL'),
            'iat' =>$creationDate->getTimestamp(),
            'exp' => $expiration->getTimestamp(),
            'id'  => $id
        ];
        $jwt = JWT::encode($payload,env('JWT_KEY'),self::hash);
        return $jwt;
    }
    public static function validate(string $jwt):Array{
        $stdClass =new stdClass();
        $decode = JWT::decode($jwt, new Key(env('JWT_KEY'), self::hash),$stdClass);
        return (Array) $decode;
    }
}