<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function category(CategoryRequest $request){

        try{
            $category = $request->validated();
            Category::create($category);
            return response()->json([
                'status' => true,
                'message'=>'category created successfully',
                'data'=> $category
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message'=>'validation failed'
            ]);
        }
     }
}
