<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\Message;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MessageController extends Controller
{
    public function index(){
        $contactInfo = ContactInfo::first();
        return view('frontend.message.index',[
            'contactInfo' => $contactInfo
        ]);
    }

    public function message(Request $request){
        $request->validate([
            'senderName'        => 'required',
            'senderEmail'       => 'required',
            'senderPhone'       => 'nullable',
            'senderMessage'     => 'required'
        ]);
        Message::storeMessage($request);
        Alert::success('Success', 'Message sent successfully.');
        return back();
    }
}
