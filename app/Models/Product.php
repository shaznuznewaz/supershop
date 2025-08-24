<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['category_id', 'name', 'description', 'price', 'quantity', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(){
        if($this->image){
            return asset('storage/'.$this->image);
        }
        return asset('images/default-product.png');
    }
}
