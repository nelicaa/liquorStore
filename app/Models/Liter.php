<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Liter extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=["liter"];

    protected $table="liters";
    public function product(){
        return $this->belongsToMany(Product::class);
    }

}
