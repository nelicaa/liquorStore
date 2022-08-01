<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = ['first_n', 'last_n', 'email',
        'password', 'street', 'phone', 'city_id', 'picture'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function city(){
    return $this->belongsTo(City::class);
    }

    public function role(){
    return $this->belongsTo(Role::class);
    }

    public function log($content){
        if(Storage::disk("local")->exists("log.txt")){
            Storage::append("log.txt",$content);
        }
        else{
            Storage::disk("local")->put("log.txt",$content);
        }
    }
}
