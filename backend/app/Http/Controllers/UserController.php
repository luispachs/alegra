<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request):JsonResponse{
       try{
        $user = new User();
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        
        return response()->json([],status:200);

       }catch(\Exception $e){
        return response()->json([],status:500);
       }
    }
}
