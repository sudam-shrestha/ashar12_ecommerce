<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{

    public function cart()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('frontend.user.cart', compact('carts'));
    }

    public function add_to_cart(Request $request)
    {
        $check_cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
        if ($check_cart) {
            $check_cart->qty = $check_cart->qty + $request->qty;
            $check_cart->amount = $check_cart->amount + $request->amount;
            $check_cart->save();
            return redirect()->back();
        }

        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = Auth::user()->id;
        $cart->qty = $request->qty;
        $cart->amount = $request->amount;
        $cart->save();
        return redirect()->back();
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $cart->update([
            'qty' => $request->qty,
            'amount' => $cart->product->price * (1 - ($cart->product->discount_percentage / 100)) * $request->qty
        ]);

        return back()->with('success', 'Cart updated successfully');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Item removed from cart');
    }
}
