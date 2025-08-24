<?php

use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\InvoiceController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\Web\PageController;
use App\Http\Middleware\JwtTokenVerify;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//backend
Route::get('/sidenav',[PageController::class,'sideNav']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('category',[CategoryController::class, 'category']);

Route::group(['prefix'=>'products'], function(){

    Route::get('/',[ProductController::class,'index']);
    Route::post('/store',[ProductController::class,'store'])->name('admin.products.store');
    Route::get('/{ProductId}',[ProductController::class,'show']);
    Route::put('/{id}',[ProductController::class,'update']);
    Route::delete('/admin/products/${id}',action: [ProductController::class,'destroy']);   
    
})->middleware(JwtTokenVerify::class);


Route::group(['prefix'=>'invoices'],function(){

    Route::post('/',[InvoiceController::class,'index']);
    Route::post('/store',[InvoiceController::class,'store']);
    Route::get('/{id}',[InvoiceController::class,'show']);
})->middleware(JwtTokenVerify::class);


Route::group(['prefix'=>'backend'], function(){

    Route::post('register',[RegisterController::class, 'register']);
    Route::post('reset/password/sent/otp',[ResetPasswordController::class, 'sentOtp']);
    Route::post('reset/password/verify/otp',[ResetPasswordController::class, 'verifyOtp']);
    Route::post('reset/password',[ResetPasswordController::class, 'resetPassword']);
    Route::post('login',[ResetPasswordController::class, 'login']);
    Route::post('logout',[ResetPasswordController::class, 'logout'])->middleware(JwtTokenVerify::class);
    Route::get('profile',[ProfileController::class, 'profile'])->middleware(JwtTokenVerify::class);
    Route::post('profile-update',[ProfileController::class, 'profileUpdate'])->middleware(JwtTokenVerify::class);



    //admin products list
    Route::group(['prefix'=>'admin/products'], function(){
        Route::get('/list', [ProductController::class, 'adminProductList'])->name('admin.products.adminProductList');
        Route::get('/edit/{product}', [ProductController::class, 'adminProductEdit'])->name('admin.products.adminProductEdit');
        Route::put('/update/{product_id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{id}',action: [ProductController::class,'destroy']);   
    })->middleware(JwtTokenVerify::class);


    
Route::group(['prefix'=>'invoices'],function(){

    Route::post('/',[InvoiceController::class,'index']);
    Route::post('/store',[InvoiceController::class,'store']);
    Route::get('show/{invoice}', [InvoiceController::class, 'show'])->name('admin.invoice.show');
    Route::get('/invoice/{invoice}/pdf', [InvoiceController::class, 'print'])->name('invoice.pdf');
    
 
})->middleware(JwtTokenVerify::class);

});


//frontend
Route::get('/',[PageController::class,'index']);
Route::get('/login',[PageController::class,'login'])->name('login');
Route::get('/register',[PageController::class,'register'])->name(name: 'register');
Route::get('/sent-otp', [PageController::class, 'sentOtp'])->name('forgot-password.sent-otp');
Route::get('/verify-otp', [PageController::class, 'verifyOtp'])->name('forgot-password.verify-otp');
Route::get('/reset-password',[PageController::class,'resetPassword'])->name('reset.password');

/*
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/profile',[PageController::class,'profile'])->name('profile');
Route::get('/profile-form',[PageController::class,'profileForm']);
Route::get('/customer/products', [CustomerController::class, 'customerProducts'])->name('customer.products');

    Route::post('/customer/product/order', [OrderController::class, 'customerOrderStore'])->name('customer.product.store');
    Route::get('/customer/orders/list', [OrderController::class, 'customerOrders'])->name('customer.order.list');

*/    



    //customer order list for admin
    Route::get('/customer/orders', [OrderController::class, 'adminCustomerOrders'])->name('admin.customer.orders');

    Route::group(['middleware'=> JwtTokenVerify::class], function(){

    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile',[PageController::class,'profile'])->name('profile');
    Route::get('/profile-form',[PageController::class,'profileForm']);
    Route::get('/customer/products', [CustomerController::class, 'customerProducts'])->name('customer.products');
    //Route::get('/store',[ProductController::class,'store'])->name('admin.products.store');

    Route::post('/customer/product/order', [OrderController::class, 'customerOrderStore'])->name('customer.product.store');
    Route::get('/customer/orders/list', [OrderController::class, 'customerOrders'])->name('customer.order.list');



    //customer order list for admin
    Route::get('/customer/orders', [OrderController::class, 'adminCustomerOrders'])->name('admin.customer.orders');
    Route::get('/dashboard/invoices',[InvoiceController::class,'customerdashboardInvoices'])->name('dashboard.invoices');
    Route::get('/admin/dashboard/invoices',[InvoiceController::class,'admindashboardInvoices'])->name('admin.dashboard.invoices');
    Route::get('/reports', [ReportController::class, 'reportPage'])->name('reports.page');
    Route::get('/reports/download', [ReportController::class, 'downloadReport'])->name('reports.download');




});