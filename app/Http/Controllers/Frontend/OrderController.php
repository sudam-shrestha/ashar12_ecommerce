<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDescription;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    public function checkout($id)
    {
        return view('frontend.user.checkout', compact('id'));
    }

    public function checkout_store(Request $request, $id)
    {
        $shop = Shop::find($id);
        $carts = Cart::where('user_id', Auth::user()->id)
            ->whereHas('product', function ($query) use ($id) {
                $query->where('shop_id', $id);
            })
            ->get();
        $total_amount = $carts->sum('amount');
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->shop_id = $shop->id;
        $order->total_amount = $total_amount;
        $order->shipping_address = $request->shipping_address;
        $order->contact = $request->contact;
        $order->payment_method = $request->payment_method;
        $order->save();

        foreach ($carts as $cart) {
            $od = new OrderDescription();
            $od->order_id = $order->id;
            $od->product_id = $cart->product_id;
            $od->qty = $cart->qty;
            $od->amount = $cart->amount;
            $od->save();
            $cart->delete();
        }

        return redirect()->route('home');
    }
}
