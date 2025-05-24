<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Tạo phản hồi mới
        Reply::create([
            'contact_id' => $contact->id,
            'admin_name' => Auth::user()->full_name ?? 'Admin',
            'reply_message' => $request->reply_message,
            'reply_date' => now(),
        ]);

        // Cập nhật trạng thái liên hệ
        $contact->status = 'read';
        $contact->save();

        return redirect()->back()->with('success', 'Đã gửi phản hồi thành công.');
    }

}
