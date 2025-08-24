<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest as RequestsProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function profile(){
        $data = Auth::user();

        return new UserResource($data);
    }

    public function profileUpdate(ProfileUpdateRequest $request){

        try{
            $user=Auth::user();
            $validated=$request->validated();

            $userData=Arr::only($validated,['name']);
            $profileData=Arr::only($validated,['phone','address']);

            $user->update($userData);

          // if profile image:

            if($request->hasFile('avatar')){
                $path  = $request->file(key: 'avatar')->store('avatars', 'public');
                $profileData['avatar'] = $path;
            }

         $user->profile()->update($profileData);

         return response()->json([
            'status'=>true,
            'message'=>'Profile updated successfully',
            'data'=>new UserResource($user)

         ],200);


        }catch (\Exception $e){
            Log::critical($e->getMessage() . ' ' .  $e->getFile() . ' ' . $e->getLine());
            return response([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
         
    }
}


