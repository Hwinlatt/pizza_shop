<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProducts;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::select('orders.*','users.name as user_name')
        ->join('users','orders.user_id','users.id')
        ->when(request('key'),function($q){
            $q->where('order_code','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc');
  
        if (request('f_status') == NULL) {
            $orders = $orders->paginate(5);
        }else{
            $orders = $orders->where('status',request('f_status'))->paginate(5);
        }
        return view('admin.order.list',compact('orders'));
    }

    public function change_status(){
        $order = Order::find(request('id'));
        $order->update([
            'status'=>request('status')
        ]);
        return response()->json(['status'=>true],200);
    }

    public function order_info($code)
    {  
        $order_info =  Order::select('orders.*','users.name as user_name')
        ->join('users','orders.user_id','users.id')
        ->where('order_code',$code)->first();
        $order_items = OrderProducts::select('order_products.*','products.name as product_name','products.image as product_image')
        ->join('products','order_products.product_id','products.id')
        ->where('order_code',$code)->get();
        return view('admin.order.info',compact('order_items','order_info'));
    }
}
