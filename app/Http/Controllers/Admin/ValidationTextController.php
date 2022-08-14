<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ValidationText;
use App\NotificationText;
use App\ManageText;
class ValidationTextController extends Controller
{

    public $notify;
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $notify=NotificationText::all();
        $this->notify=$notify;
    }


    public function index(){
        $validationTexts=ValidationText::all();
        $websiteLang=$this->websiteLang;
        return view('admin.validation-text.index',compact('validationTexts','websiteLang'));
    }

    public function update(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        foreach($request->customs as $index => $custom){

            if($request->customs[$index]==''){
                $notification=array(
                    'messege'=>$this->notify->where('id',33)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $validationText=ValidationText::find($request->ids[$index]);
            $validationText->custom_text=$request->customs[$index];
            $validationText->save();
        }

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function notification(){
        $notifications=NotificationText::all();
        $websiteLang=$this->websiteLang;
        return view('admin.notification-text.index',compact('notifications','websiteLang'));
    }

    public function updateNotification(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        foreach($request->customs as $index => $custom){
            if($request->customs[$index]==''){
                $notification=array(
                    'messege'=>$this->notify->where('id',33)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $notificationText=NotificationText::find($request->ids[$index]);
            $notificationText->custom_text=$request->customs[$index];
            $notificationText->save();
        }
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }
}
