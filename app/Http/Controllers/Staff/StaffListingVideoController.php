<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Listing;
use App\ListingVideo;
use App\ManageText;
use Auth;

use App\NotificationText;
use App\ValidationText;
class StaffListingVideoController extends Controller
{

    public $notify;
    public $errorTexts;
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:staff');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function index($id){
        $listing=Listing::find($id);
        $websiteLang=$this->websiteLang;
        if($listing){
            $user=Auth::guard('staff')->user();
            if($user->author_id==$listing->admin_id){
                $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
                return view('staff.listing.video',compact('listing','websiteLang','confirmNotify'));
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('staff.listing.index')->with($notification);
            }


        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('staff.listing.index')->with($notification);
        }
    }

    public function newVideo(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->video[0]==null){
            $notification=array(
                'messege'=> $this->errorTexts->where('id',37)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }

        // for video
        if($request->video){
            foreach($request->video as $vd){
                if($vd != null){
                    $url = $vd;
                    if(preg_match('/https:\/\/www\.youtube\.com\/watch\?v=[^&]+/', $url)) {
                        $video= new ListingVideo();
                        $video->listing_id=$request->listing_id;
                        $video->video_link=$vd;
                        $video->save();
                    }

                }
            }
        }

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteVideo($id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $video=ListingVideo::find($id);
        $video->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }
}
