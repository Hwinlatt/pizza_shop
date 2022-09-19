<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // direct catgory list page
    public function list()
    {
        $categories = Category::when(request('key'),function($q){
            $q->where('name','like','%'.request('key').'%');
        })->orderBy('id','desc')->paginate(5);
        return view('admin.category.list',compact('categories'));
    }

    //go to create page
    public function createPage()
    {
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request)
    {
        $request->validate([
            'categoryName'=>'required|unique:categories,name',
        ]);
        Category::create(['name'=>$request->categoryName]);
        return redirect()->route('category#list')->with('success','Created Successful ');
    }

    public function delete($id)
    {
        $category = Category::where('id',$id)->delete();
        return back()->with('success', 'Successfully Deleted.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'categoryName'=>'required|unique:categories,name,'.$id,
        ]);
        $category = Category::find($id);
        $category->name = $request->categoryName;
        $category->update();
        return redirect()->route('category#list');
    }
}
