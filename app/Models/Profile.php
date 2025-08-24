<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable=['user_id','phone','address','avatar'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getAvatarUrlAttribute()
    { 
        
        //  return $this->avatar ? Storage::url($this->avatar) : null;  
        
        if($this->avatar){
            return asset('storage/'.$this->avatar);
        }

        return asset('images/default-avatar.png');
         
       
    }
}
