<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerProducts(){
        $products=Product::get();
        return view ('pages.dashboard.customers.products.list',compact('products'));
    }
}
