<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
protected $fillable=["quantity", "cart_id", "price_id"];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
    public function product(){
        return $this->hasManyThrough(ProductLiter::class, Price::class,"product_liter_id", "id");
    }

    public function order($id){
        return $this->hasMany(Price::class)->where("product_liter_id", $id);

    }

    public function price(){
        return $this->belongsTo(Price::class)->withTrashed();
    }


}
