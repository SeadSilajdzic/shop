<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index() 
    {
        return view('contact');
    }

    public function createQuestion (Request $request) 
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:255',
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        toast('Message sent!','success')->autoClose(1500);
        return redirect()->back();
    }

    public function readQuestions (Request $request)
    {
        return view('admin.contactUs.index', ['messages' => ContactUs::simplePaginate(10)->items()]);
    }
}
