<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactMessage(Request $request){
//        dd($request->toArray());
        $request->validate([
           'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        return redirect()->route('user_home');
    }
    public function contactList(){
        $contacts = Contact::orderBy('id','desc')->paginate(5);
        return view('admin.contact.list',compact('contacts'));
    }
}
