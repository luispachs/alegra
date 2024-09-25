<?php 

namespace App\Security;

use DateInterval;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use \stdClass;

class Authentication{
    const string hash = 'HS512';
    const string key = "5c7cfd2da9de3dc0fe0982ee2feaa1344bb120c6";
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
        //$key =(string) env('JWT_KEY');
        $jwt = JWT::encode($payload,self::key ,self::hash);
        return $jwt;
    }
    public static function validate(string $jwt):Array{
        $stdClass =new stdClass();

        //$key = (string) env('JWT_KEY');
        
        $decode = JWT::decode($jwt, new Key(self::key, self::hash),$stdClass);
        return (Array) $decode;
    }
}