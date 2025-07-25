<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/", [PageController::class, "home"])->name("home");
Route::post("/shop-request", [PageController::class, "shop_request"])->name("shop_request");
Route::get("/shop/{id}", [PageController::class, "shop"])->name("shop");
Route::get("/product/{id}", [PageController::class, "product"])->name("product");
