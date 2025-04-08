<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
class ContactController extends Controller
{
    public function create(){
        return view('contact.create');
    }

    public function store(ContactRequest $request){
        $data = $request->all();
        Mail::raw("Tên: {$data['FullName']}
        \nEmail: {$data['Email']}
        \nPhone: {$data['Phone']}
        \nNội dung: {$data['Message']}", function ($message) use ($data){
            $message->to($data['Email']);
        });
        return back()->with('success','Gửi liên hệ thành công');
    }

}
