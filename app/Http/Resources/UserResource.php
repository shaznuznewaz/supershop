<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
    Log::info('Profile:', ['profile' => $this->profile]);
        return [
           // 'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'phone' => $this->profile->phone??null,
            'address' => $this->profile->address??null,
            'avatar'=> $this->profile->avatar_url,
            //'status'=>$this->email? 'active' : 'inactive'
        ];
    }
}
