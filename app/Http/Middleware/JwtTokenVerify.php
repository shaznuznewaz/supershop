<?php

namespace App\Http\Middleware;

use App\Helpers\JwtToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtTokenVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if(!$request->cookie('logINToken')) {
            return response()->json([
                'status' => false,
                'message'=>'Token not found'
            ]);
        } 
        $decode=JwtToken::verifyToken($request->cookie('logINToken'));
        if($decode['error']){
            return response()->json([
                'status' => false,
                'message'=>$decode['message']
            ]);
        }

        $user=User::where('email',$decode['payload']->email)->first();

        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }
        Auth::setUser($user);
    
        return $next($request);
    }
}
