<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('pages.home');
    }
    public function login(){
        return view('pages.auth.login');
    }

    public function register(){
        return view('pages.auth.register');
    }

    public function sentOtp(){
        return view('pages.auth.sent-otp-page');
    }

    public function verifyOtp(){
        return view('pages.auth.verify-otp-page');
    }

    public function resetPassword(){
        return view('pages.auth.reset-password-page');
    }

    public function dashboard(){
        return view('pages.dashboard.dashboard-page');
    }
    public function profile(){
        return view('pages.dashboard.profile');
    }
    public function profileForm(){
        return view('pages.dashboard.profile');
    }
    
}
