<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home()
    {
        $products = Product::orderBy('id','desc')->get();
        $categories = Category::all();
        return view('user.home',compact('products','categories'));
    }

    public function changePasswordPage()
    {
        return view('user.profile.password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
        ]);
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->oldPassword, $user->password)) {
            $request->validate([
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword'
            ]);
            if (Hash::check($request->newPassword, $user->password)) {
                return back()->with('warning', 'New password cannot be same with old Password');
            }
            $user->update([
                'password' => Hash::make($request->newPassword),
            ]);
            return back()->with('success', 'Password Changed');
        } else {
            return back()->with('warning', 'old Password does not math!');
        }
    }

    public function profile()
    {
        return view('user.profile.profile');
    }

    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ]);
        $user = User::find($id);
        if ($request->hasFile('image')) {
            $path = 'storage/profile_photos/'.$user->image;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif',
            ]);
            $image = uniqid() . $request->file('image')->getClientOriginalName();
            if ($user->image != NULL) {
            }
            $request->file('image')->storeAs('public/profile_photos', $image);
            $user->image = $image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->update();
        return back()->with('status','Update Profile Successful');
    }


    public function remove_all_carts()
    {
        Cart::where('user_id',Auth::user()->id)->delete();
        return back();
    }
}
