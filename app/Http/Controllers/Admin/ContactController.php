<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(6);
        return view('admin.contact.list',compact('contacts'));
    }

    public function more_info($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.read',compact('contact'));
    }

    public function destroy()
    {
        Contact::find(request('id'))->delete();
        return response()->json(['status'=>true], 200);
    }
}
