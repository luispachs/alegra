<?php

namespace App\Http\Controllers;

use App\Security\Authentication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\{Auth, Hash, Log};
use App\Repository\UserRepository;

class AuthController extends Controller
{   /**
    *  Method for process the login action for the users
    *
    *  @method Index
    *  @param Request $request
    *  @return JsonResponse
    */
    public function index(Request $request,UserRepository $userRepository): JsonResponse{
        try{
            $email =  $request->input('email');
            $password=$request->input('password');

            $user = $userRepository->getByEmail($email);
            if(!Hash::check($password,$user->password)){
                return response()->json(['error'=>__('error_invalid_credentials')],401);
            }

            $jwt = Authentication::jwt($email,$user->id);
      
          return response()->json(['status'=>'succesfull',"token"=> $jwt],200);
        }catch(\Exception $e){
            Log::error($e->getMessage(),["trace"=>$e->getTraceAsString()]);
            return response()->json(['error'=>__('general_exception')],status:500);
        }
    }

    public function validate(Request $request,UserRepository $userRepository): JsonResponse{
        try{
            $header =  $request->header('Authorization');
            $token = str_replace('Bearer ','',$header);
            $jwt = Authentication::validate($token);
      
            return response()->json(['status'=>'succesfull',"message"=>"authorize"],200);
        }catch(\Exception $e){
            return response()->json(['status'=>'unauthorize'],401);
        }
    }
}
