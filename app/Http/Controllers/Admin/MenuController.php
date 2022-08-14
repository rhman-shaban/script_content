<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Navigation;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
class MenuController extends Controller
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
        $navigations=Navigation::all();
        $websiteLang=$this->websiteLang;
        return view('admin.navbar.index',compact('navigations','websiteLang'));
    }


    public function update(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        foreach($request->navbars as $index => $navbar){

            if($request->navbars[$index]==''){
                $notification=array(
                    'messege'=>$this->notify->where('id',33)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('admin.menu-section')->with($notification);
            }

            $navigation=Navigation::find($request->ids[$index]);
            $navigation->navbar=$request->navbars[$index];
            $navigation->save();
        }
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.menu-section')->with($notification);
    }


    public function changeStatus($id){
        $navbar=Navigation::find($id);
        if($navbar->status==1){
            $navbar->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $navbar->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $navbar->save();
        return response()->json($message);

    }
}
