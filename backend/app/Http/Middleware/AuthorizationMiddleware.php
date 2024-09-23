<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Security\Authentication;
class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $header = $request->header('Authorization');
        if($header ==null){
            return response()->json(['status' => "unauthorize"],401);
        }
        try{
            $token = str_replace('Bearer ','',$header);
            $payload = Authentication::validate($token);
            
            return $next($request);
        }
        catch(\Exception $e){
            return response()->json(['status'=>'unauthorize'],401);
        }
    }
}
