<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::select('products.*','categories.name as category_name')->when(request('key'), function ($q) {
            $q->where('name', 'like', '%' . request('key') . '%');
        })->join('categories','products.category_id','categories.id')
            ->orderBy('products.id', 'desc')
            ->paginate(2);
        return view('admin.product.list', compact('products'));
    }

    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    // Insert Into Product
    public function insert(Request $request)
    {
        $this->productValidate($request, 'create');
        $image = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/product_photos', $image);
        Product::create(
            $this->createCategory($request, $image)
        );
        return redirect()->route('products')->with('success', 'Product Create Successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $path = 'storage/product_photos/' . $product->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $product->delete();
        return back()->with('success', 'Product delete successful!');
    }

    public function view_more($id)
    {
        $product = Product::find($id);

        return view('admin.product.view', compact('product'));
    }

    public function editpage($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update($id, Request $request)
    {
        $this->productValidate($request, 'update');
        $product = Product::find($id);
        if ($request->hasFile('image')) {
            $image = uniqid() . $request->file('image')->getClientOriginalName();
            $path = 'storage/product_photos/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $request->file('image')->storeAs('public/product_photos', $image);
            $product->update($this->createCategory($request,$image));
        }else{
            $product->update($this->createCategory($request,NULL));
        }
        return redirect()->route('products')->with('success','Updatesuccessful');
    }



    private function createCategory($req, $img)
    {
        $action = [
            'name' => $req->name,
            'category_id' => $req->category,
            'descriptin' => $req->description,
            'waiting_time' => $req->waitingTime,
            'price' => $req->price,
        ];
        if ($img != NULL) {
            $action += ['image' => $img];
        }
        return $action;
    }

    private function productValidate($request, $type)
    {
        $action = [
            'name' => 'required|min:5|unique:products,name,' . $request->id,
            'category' => 'required',
            'description' => 'required|min:10',
            'image' => 'image',
            'waitingTime' => 'required',
            'price' => 'required'
        ];
        if ($type == 'create') {
            $action['image'] = 'required|image';
        }
        return $request->validate($action);
    }
}
