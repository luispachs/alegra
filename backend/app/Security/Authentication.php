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
        $key =(string) env('JWT_KEY');
        $jwt = JWT::encode($payload,$key ,self::hash);
        return $jwt;
    }
    public static function validate(string $jwt):Array{
        $stdClass =new stdClass();
        $key = (string) env('JWT_KEY');
        $decode = JWT::decode($jwt, new Key($key, self::hash),$stdClass);
        return (Array) $decode;
    }
}