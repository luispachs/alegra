<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class OrdenTest extends TestCase
{
  
    public static function customers():array
    {
        return   [
            ["laps1308+01@gmail.com","luis",'','pacheco',200],
            ["laps1308+02@gmail.com","luis",'','pacheco',200],
            ["laps1308+03@gmail.com","luis",'','pacheco',200],
            ["laps1308+04@gmail.com","luis",'','pacheco',200],
            ["laps1308+05@gmail.com","luis",'','pacheco',200],
            ["laps1308+06@gmail.com","luis",'','pacheco',200],
            ["laps1308+07@gmail.com","luis",'','pacheco',200],
            ["laps1308+08@gmail.com","luis",'','pacheco',200],
            ["laps1308+09@gmail.com","luis",'','pacheco',200],
            ["laps1308+010@gmail.com","luis",'','pacheco',200],
            ["laps1308+011@gmail.com","luis",'','pacheco',200],
            ["laps1308+012@gmail.com","luis",'','pacheco',200],
            ["laps1308+013@gmail.com","luis",'','pacheco',200],
        
     
            
        ];
    }
    #[DataProvider('customers')]
     public function test_order(string $email,string $name,string $middlename,string $lastname ,int $code):void{
        $token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0IiwiYXVkIjoiaHR0cDovL2xvY2FsaG9zdCIsImlhdCI6MTcyNzEyODUxMywiZXhwIjoxNzI3MTU3MzEzLCJpZCI6MTAwMH0.6jn-Mzlmy231_uEr_bQHyWxEhpOkWmwOhGJ2WfuPYuhdmeqn4s-VYbszMaNjUabBQgXIct1RbTM6W5sDD6xCrA';
        $response = $this->putJson('/api/kitchen/orden/put',['email'=> $email,'firstname' => $name,'middlename' => $middlename,'lastname' => $lastname],['Authorization' => "Bearer ".$token,'Content-Type'=>'Application/json']);
         print_r($response->json());
        $response->assertStatus($code);

        
     }
}
