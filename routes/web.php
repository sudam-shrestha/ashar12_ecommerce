<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get("/", [PageController::class, "home"])->name("home");
Route::post("/shop-request", [PageController::class, "shop_request"])->name("shop_request");
Route::get("/shop/{id}", [PageController::class, "shop"])->name("shop");
Route::get("/product/{id}", [PageController::class, "product"])->name("product");

Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('add-to-cart', [CartController::class, "add_to_cart"])->name("add_to_cart");

    Route::get('/cart', [CartController::class, "cart"])->name("cart");

    Route::put('/cart/update/{id}', [CartController::class, "update"])->name("cart.update");

    Route::delete('cart/destroy/{id}', [CartController::class, "destroy"])->name("cart.destroy");

    Route::get('checkout/{id}', [OrderController::class, "checkout"])->name("checkout");
    Route::post('checkout/{id}', [OrderController::class, "checkout_store"])->name("checkout.store");
});

Route::get('/voucher/{id}', function ($id) {
    $order = Order::find($id);
    return view('voucher', compact('order'));
})->name('shop.voucher');


require __DIR__ . '/auth.php';
