<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscribe;
use App\SubscriberEmail;
use App\ManageText;
use App\Mail\SendSubscriberMail;
use Mail;

use App\NotificationText;
use App\ValidationText;

use App\Helpers\MailHelper;
class SubscriberController extends Controller
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
        $subscribers=Subscribe::where('status',1)->get();
        $websiteLang=$this->websiteLang;
        $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('admin.subscriber.subscriber.index',compact('subscribers','websiteLang','confirmNotify'));
    }

    public function delete($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        Subscribe::destroy($id);
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function emailTemplate(){
        $template=SubscriberEmail::first();
        $websiteLang=$this->websiteLang;
        return view('admin.subscriber.email.index',compact('template','websiteLang'));
    }

    public function sendMail(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'subject'=>'required',
            'message'=>'required',
        ];

        $customMessages = [
            'subject.required' => $this->errorTexts->where('id',6)->first()->custom_text,
            'message.required' => $this->errorTexts->where('id',7)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $template=SubscriberEmail::first();
        $template->subject=$request->subject;
        $template->message=$request->message;

        $subscribers=Subscribe::where('status',1)->get();
        if($subscribers->count()==0){
            $notification=array(
                'messege'=>"Subscriber Not Found!",
                'alert-type'=>'error'
            );

            return back()->with($notification);
        }
        MailHelper::setMailConfig();

        foreach($subscribers as $subscriber){
            Mail::to($subscriber->email)->send(new SendSubscriberMail($template));
        }
        $notification=array(
            'messege'=>$this->notify->where('id',24)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
