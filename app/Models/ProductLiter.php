<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLiter extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=["product_id","liter_id","image", "date"];


public function category(){

            return $this->hasOneThrough(Category::class, Product::class,  "products.id", "products.category_id","", "categories.id");
}

    public function liter(){
        return $this->belongsTo(Liter::class);

    }

    public function order(){
        return $this->hasManyThrough(Order::class, Price::class,"id", "price_id");
    }


//
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function price(){
        return $this->hasMany(Price::class)->withTrashed();
    }
    public function priceWithoutTrashed(){
        return $this->hasMany(Price::class);
    }


}
