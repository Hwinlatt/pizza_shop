<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function cart_list()
    {
        $carts = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price')
            ->join('products', 'carts.product_id', 'products.id')->where('carts.user_id', Auth::user()->id)->get();
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->qty * $cart->pizza_price;
        }
        return view('user.cart', compact('carts', 'totalPrice'));
    }

    //Order History
    public function order_history()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('user.orderhistory', compact('orders'));
    }

    //Contact Page
    public function contact_page()
    {
        return view('user.contact');
    }

    //Submit Contact 
    public function contact_add(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "email" => 'required||email',
            "subject" => 'required',
            "message" => 'required',
        ]);
        Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message,
        ]);
        return redirect()->route('user#home');
    }
}
