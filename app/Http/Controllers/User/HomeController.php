<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sorting()
    {
        $products = Product::orderBy('id',request('sortBy'))->get();
        return response()->json($products);
    }

    public function filter($id)
    {
        $products = Product::where('category_id',$id)->orderBy('id','desc')->get();
        $categories = Category::all();
        return view('user.home',compact('products','categories'));
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $product->view_count += 1;
        $product->update();
        $products = Product::all();
        return view('user.detail.detail',compact('product','products'));
    }
}
