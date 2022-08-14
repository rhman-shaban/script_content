<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ListingReview;
use App\ManageText;
use App\NotificationText;
class ListingReviewController extends Controller
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
        $reviews=ListingReview::orderBy('id','desc')->get();
        $websiteLang=$this->websiteLang;
        $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('admin.review.index',compact('reviews','websiteLang','confirmNotify'));
    }



    public function destroy($id)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $review=ListingReview::find($id);
        $review->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.listing-review')->with($notification);
    }

    public function changeStatus($id){
        $review=ListingReview::find($id);
        if($review->status==1){
            $review->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $review->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $review->save();
        return response()->json($message);

    }
}
