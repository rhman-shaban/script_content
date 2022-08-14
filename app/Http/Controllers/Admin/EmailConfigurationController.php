<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\EmailConfiguration;

class EmailConfigurationController extends Controller
{

    public $notify;
    public $errorTexts;
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function index(){
        $websiteLang=$this->websiteLang;
        $email=EmailConfiguration::first();
        return view('admin.email-configuration.index',compact('email','websiteLang'));
    }

    public function update(Request $request){


        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'email'=>'required',
            'mail_host'=>'required',
            'mail_port'=>'required',
            'mail_encryption'=>'required',
            'smtp_username'=>'required',
            'smtp_password'=>'required',

        ];

        $customMessages = [
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'smtp_username.required' => $this->errorTexts->where('id',97)->first()->custom_text,
            'smtp_password.required' => $this->errorTexts->where('id',98)->first()->custom_text,
            'mail_host.required' => $this->errorTexts->where('id',96)->first()->custom_text,
            'mail_port.required' => $this->errorTexts->where('id',99)->first()->custom_text,
            'mail_encryption.required' => $this->errorTexts->where('id',100)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $email=EmailConfiguration::first();
        $email->email=$request->email;
        $email->mail_host=$request->mail_host;
        $email->mail_port=$request->mail_port;
        $email->smtp_username=$request->smtp_username;
        $email->smtp_password=$request->smtp_password;
        $email->mail_encryption=$request->mail_encryption;
        $email->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.email-configuration')->with($notification);

    }
}
