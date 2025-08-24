<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){

       
    $products = Product::with('category')->get();

    return view('admin.products.index', compact('products'));
        
    }

    public function store(ProductRequest $request){

        try{
            $productData=$request->validated();

            

            if($request->hasFile('image')){
                $path=$request->file('image')->store('products', 'public');
                $productData['image']=$path;
            }

            //$productData=$request->except('image');// if you want to handle image separately
           $product= Product::create($productData);
            return response()->json([
                'status' => true,
                'message'=>'Product created successfully',
                'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'category_name' => $product->category->name ?? '',
                'description' => $product->description,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'image' => $product->image, // stored path
            ]
            ]);


        }catch(\Exception $e){

        }
    }

    //public function(Product $product) //if use model Product then no need to write Model under function ex : Product::
    public function show($productId){

        $product=Product::find($productId);
        if(!$product){
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ]);
        }

            return response()->json([
                'status' => true,
                'message'=>'product found successfully',
                'data'=>$product
            ]);
    }

    Public function update($productId, ProductRequest $request){

        try{
            $product=Product::find($productId);
            if(!$product){
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                ]);
            }

            $productData=$request->validated();
            if($request->hasFile('image')){
                if($product->image){
                    Storage::disk('public')->delete($product->image??'');
                }
                $path=$request->file('image')->store('products', 'public');
                $productData['image']=$path;
            }

            $product->update($productData);

            
            if($request->expectsJson()){

            }
            else{
                return redirect('backend/admin/products/list');
            }
            return response()->json([
                'status' => true,
                'message'=>'Product updated successfully',
                'data'=>$productData
            ]
        );

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message'=>'Failed to update product',
            ]);
        }
    }

    public function destroy($id){

        
    $product = Product::find($id);

    if (!$product) {
        return response()->json([
            'message' => 'Product not found'
        ], 404);
    }

    
    if($product->image && Storage::disk('public')->exists($product->image)){
        Storage::disk('public')->delete($product->image);
    }

    
    $product->delete();

    return response()->json([
        'message' => 'Product deleted successfully'
    ]);
    }


    public function adminProductList(){

        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('pages.dashboard.admin.products.list',compact('products','categories'));
    }

      public function adminProductEdit(Product $product){

        $categories=Category::get();
        return view('pages.dashboard.admin.products.edit',compact('product','categories'));
    }
}
