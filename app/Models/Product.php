<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
protected $table="products";
protected $fillable=["name","desc", "category_id"];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function price(){
        return $this->hasManyThrough(Price::class, ProductLiter::class)->orderBy("product_liters.id");
    }


    public function liter(){
        return $this->belongsToMany(Liter::class,"product_liters")->withPivot('image')->whereNull('product_liters.deleted_at')->orderBy("product_liters.id");
    }

    public function literOneProduct($id){
        return $this->hasManyThrough(Price::class, ProductLiter::class)->where("product_liters.id",$id);
    }



}
