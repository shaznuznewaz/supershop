<?php

namespace App\Http\Controllers;

use App\Helpers\JwtToken;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ResetPasswordSentOtpRequest;
use App\Http\Requests\ResetPasswordVerifyOtpRequest;
use App\Http\Resources\UserResource;
use App\Mail\SentOtpMail;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function sentOtp(ResetPasswordSentOtpRequest $request)
    {
        try{
            $otp=mt_rand(100000, 999999);

            Otp::create([

                'email'=>$request->email,
                'otp'=>$otp
            ]);

            Mail::to($request->email)->send(new SentOtpMail( $otp));

            return response()->json([
                'status' => true,
                'message'=> 'OTP sent to your email',
            ],201);

        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status'=>false,
                'message'=>'Failed to send OTP',
            ],500);
        }
        

    }

    

        public function verifyOtp(ResetPasswordVerifyOtpRequest $request){
            
            try{
                $otpUpdate=Otp::where('email',$request->email)->where('otp',$request->otp)->update([
                    'status'=>true
                ]);

                if(!$otpUpdate){
                    return response()->json([
                        'status'=>false,
                        'message'=>'failed to verify otp'
                    ]);
                }

                $cookieMinute=60; //1 hour
                $jwtexpTime=time()+60*60;// 1 hour
                $token=JwtToken::createToken(['email'=>$request->email],$jwtexpTime);
                return response()->json([
                    'status'=>true,
                    'message'=>'OTP verified Successfully',

                ],201)->cookie('resetPasswordToken',$token['token'],$cookieMinute);
                 

            }catch(\Exception $e){
                Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
                return response()->json([
                    'status'=>false,
                    'message'=>'something went wrong'
                ]);
            }


        }

       public function resetPassword(ResetPasswordRequest $request){

        try{
            if(!$request->cookie('resetPasswordToken'))
            {
                return response()->json([
                    'success'=>false,
                    'message'=>'Token not found'
                ]);
            }

            $decode=JwtToken::verifyToken($request->cookie('resetPasswordToken'));
            if($decode['error']){
                return response()->json([
                    'success'=>false,
                    'message'=>$decode['message']
                ]);
            }

            $user=User::where('email',$decode['payload']->email)->first();
            $user->password=Hash::make($request->password);
            $user->save();

            return response()->json([
                'status'=>true,
                'message'=>'Password reset successfully'
            ],201)->withoutCookie('resetPasswordToken');
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'success'=>false,
                'message'=>'Something went wrong'
            ]);
        }

       }


       public function login(LoginRequest $request){

        try{
            $user=User::where('email',$request->email)->first();
            if(!Hash::check($request->password,$user->password))
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'Invalid credintials'
                ],422);
            }
            $userData=[
                'name'=>$user->name,
                'email'=>$user->email,
                'id'=>$user->id,
                'role'=>$user->role,
                'avatar'=>$user->profile->avatar_url
            ];

            $cookieMinutes=60*24;
            $jwtexpTime=time()+60*60*24;
        
              $token=JwtToken::createToken($userData,$jwtexpTime); 
            

            return response()->json([
                'status'=>true,
                'message'=>'login successfull',
                'data'=>$userData
            ],201)->cookie('logINToken',$token['token'],$cookieMinutes);
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status'=>false,
                'message'=>'Something went wrong'

            ]);
        }
       }

       public function logout(){

         try{
             return response()->json([
                    'status'=>true,
                    'message'=>'logout successful'
             ],201)->withoutCookie('logINToken');
             
         }catch(\Exception $e){
                Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());    
                return response()->json([
                    'success'=>false,
                    'message'=>'Something went wrong'
                ]);
         }
       }


       public function profile(){

        //return Auth::user();
       $user=Auth::user();
       return new UserResource($user);
  

       }

       

} 
