<?php
namespace App\Http\Middleware;

use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\InvoiceController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;

use App\Http\Middleware\JwtTokenVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('category',[CategoryController::class, 'category']);

Route::group(['prefix'=>'products'], function(){

    Route::get('/',[ProductController::class,'index']);
    Route::post('/store',[ProductController::class,'store']);
    Route::get('/{ProductId}',[ProductController::class,'show']);
    Route::put('/{id}',[ProductController::class,'update']);
    Route::delete('/{id}',[ProductController::class,'destroy']);   
    
})->middleware(JwtTokenVerify::class);


Route::group(['prefix'=>'invoices'],function(){

    Route::post('/',[InvoiceController::class,'index']);
    Route::post('/store',[InvoiceController::class,'store']);
    Route::get('/{id}',[InvoiceController::class,'show']);
})->middleware(JwtTokenVerify::class);


Route::post('register',[RegisterController::class, 'register']);
Route::post('reset/password/sent/otp',[ResetPasswordController::class, 'sentOtp']);
Route::post('reset/password/verify/otp',[ResetPasswordController::class, 'verifyOtp']);
Route::post('reset/password',[ResetPasswordController::class, 'resetPassword']);
Route::post('login',[ResetPasswordController::class, 'login']);
Route::post('logout',[ResetPasswordController::class, 'logout'])->middleware(JwtTokenVerify::class);
Route::get('profile',[ResetPasswordController::class, 'profile'])->middleware(JwtTokenVerify::class);
