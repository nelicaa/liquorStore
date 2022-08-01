<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth as Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/home', '/');
Route::get("/",[\App\Http\Controllers\HomeController::class,"index"])->name("home");


Route::post("/login", [\App\Http\Controllers\Auth::class,"login"])->name("login")->middleware('LoginMiddlware');;
Route::get("/logout", [\App\Http\Controllers\Auth::class,"logout"])->name("logout");
//Route::post("/loginSession", [\App\Http\Controllers\Auth::class,"loginSession"])->name("loginSession");
Route::get("/searchCityZip", [\App\Http\Controllers\CityController::class,"searchCityZip"])->name("searchCityZip");
Route::get("/products", [\App\Http\Controllers\ProductController::class,"showProducts"])->name("products");
Route::get("/products/{id}", [\App\Http\Controllers\ProductController::class,"showOne"])->name("products/id");
Route::get("/product/{id}", [\App\Http\Controllers\ProductController::class,"showProduct"])->name("product");
Route::get("/filterSort/{id}", [\App\Http\Controllers\ProductController::class,"filterSort"])->name("filterSort");
Route::post('sendMail', [\App\Http\Controllers\ContactController::class,"sendMail"])->name("sendMail");
Route::post('/cart', [\App\Http\Controllers\CartController::class,"index"])->name("cart")->middleware('loggedInUser');
Route::get('/myCart', [\App\Http\Controllers\CartController::class,"myCart"])->name("myCart")->middleware('loggedInUser');
Route::get('/deleteCart/{id}', [\App\Http\Controllers\CartController::class,"delete"])->name("deleteCart")->middleware('loggedInUser');
Route::get('/store', [\App\Http\Controllers\CartController::class,"store"])->name("store")->middleware('loggedInUser');
Route::get('/indexJs', [\App\Http\Controllers\CityController::class,"indexJs"])->name("indexJs");
Route::get('/about', [\App\Http\Controllers\HomeController::class,"about"])->name("about");

//});
Route::resources([
    'auth' => Auth::class,
    'contact'=>\App\Http\Controllers\ContactController::class
]);

Route::middleware(['loggedInAdmin'])->group(function () {
    Route::get("/dashboard", [\App\Http\Controllers\DashController::class,"index"])->name("dashboard");
    Route::get("/deleteMess/{id}", [\App\Http\Controllers\DashController::class,"deleteMess"])->name("deleteMess");
    Route::get("/registerDateFilter/{value}", [\App\Http\Controllers\DashController::class,"register"])->name("registerDateFilter");
    Route::get("/listLogInOut", [\App\Http\Controllers\DashController::class,"listLogInOut"])->name("listLogInOut");
    Route::get("/listLogInOutFilter", [\App\Http\Controllers\DashController::class,"listLogInOutFilter"])->name("listLogInOutFilter");
    Route::get("/removeFilter", [\App\Http\Controllers\DashController::class,"removeFilter"])->name("removeFilter");
    Route::get("/showCartProducts", [\App\Http\Controllers\CartController::class,"showCartProducts"])->name("showCartProducts");
    Route::get("/showCart", [\App\Http\Controllers\CartController::class,"showCart"])->name("showCart");
    Route::resources([
        'productsAdmin'=>\App\Http\Controllers\ProductController::class,
        'city'=>\App\Http\Controllers\CityController::class,
        'category'=>\App\Http\Controllers\CategoryController::class,
        'liter'=>\App\Http\Controllers\LiterController::class,
        'role'=>\App\Http\Controllers\RoleController::class,
        'user'=>\App\Http\Controllers\UserController::class


    ]);
});
