<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class LoginTest extends TestCase
{
  
    public static function credentials():array
    {
        return   [
            ["laps1308@gmail.com","lapsDev1308",200],
            ["laps1308@gmail.com","lapsdev1308",401],
            ["laps1308gmail.com","lapsDev1308",500],
            ["laps1308@gmail.com","lapsDev1308",200],
            ["laps1308@gmail.net","lapsDev108",401],
            ["laps1308@gmail.com","123456789",401],
            ["luis.pacheco@newcomm.one","lapsDev1308",401],
            ["laps1308@gmail.com","lapsDev1308",200],
            ["laps1308@gmai.com","lapsDev",401],
            ["laps1308+05@gmail.com","lsDev1308",401],
            ["laps1308@gmail.com","lapsDev1308",200],
     
            
        ];
    }
    #[DataProvider('credentials')]
     public function test_loginUser(string $email,string $password,int $code):void{
        $response = $this->postJson('/api/auth',['email'=> $email,'password' => $password]);
         print_r($response->json());
        $response->assertStatus($code);

        
     }
}
