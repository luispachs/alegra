<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{   /**
    *  Method for process the login action for the users
    *
    *  @method Index
    *  @param Request $request
    *  @return JsonResponse
    */
    public function index(Request $request): JsonResponse{

        
        return response()->json(['h'=>1]);
    }
}
