<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){

        try{

            $register=$request->validated();

            $userData=Arr::only($register,['name','email','password','role']);
            $profileData=Arr::only($register,['phone','address']);

            $user=User::create($userData);
            $profileData['user_id']=$user->id;
            if($request->hasFile('avatar')){
                $path=$request->file('avatar')->store('public/avatars');
                $profileData['avatar']=$path;
            }


            //$profile=$user->profile()->create($profileData);
            profile::create($profileData);

            return response()->json([
                'status'=>true,
                'message'=>'User registered successfully',
                'data'=>$user
            ],201);

        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status'=>false,
                'message'=>'Registration failed'
            ],500);
        }
        


    }
}
