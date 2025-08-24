<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;

class JwtToken
{


    public static function createToken(array $userdata,$exp):array
    {

        try{
            $key=config('jwt.jwt_key');

            $payload=$userdata+[
                'iss'=>'Inventory Management System',
                'iat'=>time(),
                'exp'=>$exp
            ];

            $token=JWT::encode($payload,$key,'HS256');

            return[
                'status'=>true,
                'message'=>'Token created successfully',
                'token'=>$token
            ];
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return [
                'status'=>false,
                'message'=>'Token creation failed: '.$e->getMessage()
            ];
        }


    } 
    
    public static function verifyToken(string $token):array
    {
        try{
            $key=config('jwt.jwt_key');

            if(!$token){
                return [
                    'error'=>true,
                    'payload'=>[],
                    'message'=>'token not found'

                ];
            }

            $payload=JWT::decode($token, new Key($key, 'HS256'));
            return [
                'error'=>false,
                'payload'=>$payload,
                'message'=>'Data Found'
            ];

        }
        catch(\Exception $e){

            Log::critical($e->getMessage().' '. $e->getFile().' '. $e->getLine());
            return [
                'error'=>true,
                'payload'=>[],
                'message'=>'Token verification failed: '.$e->getMessage()
            ];
        }
    }

    /*
    public function __construct()
    {
        //
    }

    */
}
