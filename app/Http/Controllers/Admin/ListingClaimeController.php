<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ListingClaime;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Listing;

class ListingClaimeController extends Controller
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
        $claimes=ListingClaime::orderby('id','desc')->get();
        $websiteLang=$this->websiteLang;
        $confirmNotify=$this->notify->where('id',42)->first()->custom_text;
        $deleteConfirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('admin.claime.index',compact('claimes','websiteLang','confirmNotify','deleteConfirmNotify'));
    }

    public function verifyListing($id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $listing=Listing::find($id);
        $listing->verified=1;
        $listing->save();

        $notification=array(
            'messege'=>$this->notify->where('id',43)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }


    public function deleteClaim($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $claim=ListingClaime::find($id);
        $claim->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }
}
