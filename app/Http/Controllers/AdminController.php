<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //Change Password Page

    public function change_pass()
    {
        return view('admin.user.change');
    }

    //Change Password in DataBase
    public function password_change(Request $request)
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

    public function profile_page()
    {
        return view('admin.user.profile');
    }

    public function edit_profile()
    {
        return view('admin.user.editprofile');
    }

    public function update_profile($id, Request $request)
    {
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
        if ($user->id == Auth::user()->id) {
            return redirect()->route('user#profile')->with('status','Update Profile Successful');
        }else{
        return redirect()->route('admin#user_list')->with('status','Update Profile Successful');

        }

    }

    public function admin_list()
    {
        $admins = User::when(request('key'),function($db){
            $db->orWhere('name','like','%'.request('key').'%')
            ->where('name','like','%'.request('key').'%')
            ->orWhere('email','like','%'.request('key').'%')
            ->orWhere('image','like','%'.request('key').'%')
            ->orWhere('phone','like','%'.request('key').'%')
            ->orWhere('gender','like','%'.request('key').'%');
        })->where('role','admin')->paginate(3);
        return view('admin.user.adminList',compact('admins'));
    }

    //Delete User with admin role
    public function destroy_user($id)
    {
        $user = User::find($id);
        $path = 'storage/profile_photos/'.$user->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $user->delete();
        return back()->with('success','Delete user Successful!');
    }
}
