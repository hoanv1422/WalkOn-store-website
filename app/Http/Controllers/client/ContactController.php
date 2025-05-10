<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    public function index()
    {
        return view('client.pages.contact.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required|string|min:5|max:1000',
        ]);

        $userId = auth()->check() ? auth()->id() : null;

        Contact::create(attributes: [
            'contact_code' => 'CNT' . now()->timestamp,
            'user_id'      => $userId,
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'message'      => $request->message,
            'status'       => 'UNREAD',
        ]);

        return back();
    }
}
