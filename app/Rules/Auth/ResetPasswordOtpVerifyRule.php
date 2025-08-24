<?php

namespace App\Rules\Auth;

use App\Models\Otp;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ResetPasswordOtpVerifyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function __construct(protected $email){

    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $getOtp=Otp::where('email', $this->email)
            ->where('otp',$value)
            ->where('status',false)
            ->where('created_at','>', now()->subMinutes(60))
            ->first();

        if(!$getOtp){
            $fail('The Provided OTP is invalid)');
        }    
    }
}
