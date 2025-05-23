<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }


    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));
    }


    // Phản hồi
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->status = 'read';
        $contact->reply_message = $request->reply_message;
        $contact->save();

        return redirect()->back()->with('success', 'Đã gửi phản hồi thành công.');
    }

}
