<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    public function home()
    {
        return view('frontend.home');
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

        return redirect()->back();
    }

}
