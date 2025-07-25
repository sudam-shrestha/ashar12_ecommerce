<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ShopRequestNotification;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends BaseController
{
    public function home()
    {
        $shops = Shop::where('status', 'approved')->where('expire_date', '>=', date('Y-m-d'))->orderBy('id', 'desc')->get();
        $products = Product::where('discount_percentage', ">", 0)->orderBy('id', 'desc')->get();
        return view('frontend.home', compact('shops', 'products'));
    }

    public function shop_request(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:shops',
            'shop_name' => 'required',
            'shop_address' => 'required',
            'contact_number' => 'required',
            'shop_type' => 'required',
        ]);

        $shop = new Shop();
        $shop->name = $request->name;
        $shop->email = $request->email;
        $shop->shop_name = $request->shop_name;
        $shop->shop_address = $request->shop_address;
        $shop->contact_number = $request->contact_number;
        $shop->shop_type = $request->shop_type;
        $shop->save();
        Mail::to("sudamshrestha939@gmail.com")->send(new ShopRequestNotification($shop));
        return redirect()->back();
    }


    public function shop(Request $request, $id)
    {
        $shop = Shop::where('status', 'approved')->where('expire_date', '>=', date('Y-m-d'))->where('id', $id)->first();
        if(!$request->sort || $request->sort == "newest"){
            $sort = "newest";
            $products = $shop->products()->orderBy('id', 'desc')->get();
        }
        else if($request->sort == "price_low_to_high"){
            $sort = "price_low_to_high";
            $products = $shop->products()->orderBy('price', 'asc')->get();
        }
        else{
            $sort = "price_high_to_low";
            $products = $shop->products()->orderBy('price', 'desc')->get();
        }
        return view('frontend.shop', compact('shop', 'products', 'sort'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        return view('frontend.product', compact('product'));
    }
}
