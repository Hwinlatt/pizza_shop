<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function products()
    {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->join('categories', 'products.category_id', 'categories.id')->get();
        return response()->json($pizzas, 200);
    }

    //Get One Product
    public function product($id)
    {
        $pizza = Product::select('products.*', 'categories.name as category_name')
            ->where('products.id', $id)
            ->join('categories', 'products.category_id', 'categories.id')->first();
        return response()->json($pizza, 200);
    }

    //Create Category
    public function create_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()->all()], 200);
        }

        Category::create([
            'name' => $request->name
        ]);
        return response()->json(['status' => true], 200);
    }

    //Update Category
    public function update_category(Request $request)
    {
        $category = Category::find($request->id);
        if (!$category) {
            return response()->json(['status' => false,'errors'=>['there is no category with this id']], 200);
        }
        $category->update([
            'name'=>$request->name
        ]);
        return response()->json(['status' => true], 200);
    }

    //Delete Category 
    public function delete_category(Request $request)
    {
        $category = Category::find($request->id);
        if (!$category) {
            return response()->json(['status' => false], 200);
        }
        $category->delete();
        return response()->json(['status' => true], 200);
    }

    // Create Contact 
    public function create_contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()->all()], 200);
        }
        Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message,
        ]);
        return response()->json(['status' => true], 200);
    }
}
