<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDescription;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        }

        if ($request->payment_method == 'khalti') {
            $response = Http::withHeaders([
                "Authorization" => "Key " . env('KHALTI_SECRET_KEY')
            ])->post("https://dev.khalti.com/api/v2/epayment/initiate/", [
                "return_url" => env('KHALTI_REDIRECT'),
                "website_url" => env("APP_URL"),
                "amount" => $order->total_amount * 100,
                "purchase_order_id" => $order->id,
                "purchase_order_name" => "Order #" . $order->id,
                "customer_info" => $order->user
            ]);

            if ($response["payment_url"]) {
                return redirect($response["payment_url"]);
            } else {
                return $response;
            }
        }

        return redirect()->route('home');
    }

    public function khalti_callback(Request $request)
    {
        $order = Order::find($request->purchase_order_id);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('shop.voucher', $order->id);
    }
}
