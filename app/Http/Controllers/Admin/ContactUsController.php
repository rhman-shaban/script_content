<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use App\ContactMessage;
use App\ManageText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;
    }

    public function message(){
        $messages=ContactMessage::orderBy('id','desc')->get();
        $websiteLang=$this->websiteLang;
        return view('admin.contact.contact-message.index',compact('messages','websiteLang'));
    }
}
