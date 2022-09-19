<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::when(request('key'),function($db){
            $db->orWhere('name','like','%'.request('key').'%')
            ->where('name','like','%'.request('key').'%')
            ->orWhere('email','like','%'.request('key').'%')
            ->orWhere('image','like','%'.request('key').'%')
            ->orWhere('phone','like','%'.request('key').'%')
            ->orWhere('gender','like','%'.request('key').'%');
        })
            ->paginate(5);
        return view('admin.user.userslist',compact('users'));
    }

    public function change_user($id)
    {
        $user = User::find($id);
        $user->role = 'user';
        $user->update();
        return back()->with('success',$user->name.' removed from Admin list!');
    }

    public function delete_user()
    {
        User::find(request('uid'))->delete();
        return response()->json(['status'=>true],200);
    }

    public function change_role()
    {
        User::find(request('uid'))
        ->update([
            'role'=>request('role')
        ]);
    }

    //Edit User
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edituser',compact('user'));
    }
}
