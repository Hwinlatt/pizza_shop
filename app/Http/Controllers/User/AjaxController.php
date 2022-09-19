<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $chkCart = Cart::where('product_id', $request->pizzaId)->where('user_id', $request->userId)->count();
        if ($chkCart) {
            return response()->json(['status' => false], 200);
        }
        Cart::create([
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->qty,
        ]);
        return response()->json(['status' => true], 200);
    }

    public function cart_count()
    {
        $order = Order::where(('user_id'),Auth::user()->id)->count();
        $count = Cart::where('user_id', Auth::user()->id)->count();
        return response()->json(['cartCount' => $count,'orderCount'=>$order], 200);
    }

    public function add_order(Request $request)
    {
        foreach ($request->carts as $cart) {
            logger($cart);
            $data = OrderProducts::create([
                'product_id'=>$cart['productId'],
                'user_id'=>Auth::user()->id,
                'qty'=>$cart['qty'],
                'total'=>$cart['total'],
                'order_code'=>'POS'.rand(1000,9999).'-'.time()
            ]);
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=>$request->totalPrice
        ]);

        return response()->json(['status'=>true],200);
    }

    //Remove One Item From Cart
    public function remove_one_cart()
    {
        if (request('id')) {
            Cart::find(request()->id)->delete();
            return response()->json(['status'=>true],200);
        }
    }
}
