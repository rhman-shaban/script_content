<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\SeoText;
Use App\ManageText;


use App\NotificationText;
use App\ValidationText;

class SeoTextController extends Controller
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

    public function index($id){
        $text=SeoText::find($id);
        if($text){
            $websiteLang=$this->websiteLang;
            return view('admin.seo.index',compact('text','websiteLang'));
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return back()->with($notification);
        }


    }


    public function update(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'title'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $text=SeoText::find($id);
        if($text){
            $text->title=$request->title;
            $text->meta_description=$request->meta_description;
            $text->save();

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return back()->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return back()->with($notification);
        }
    }
}
