<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Wishlist;
use App\Listing;
use App\ListingReview;
use App\ListingAminity;
use App\ListingVideo;
use App\ManageText;
use App\ListingImage;
use App\ListingClaime;
use Image;
use File;

use App\NotificationText;
use App\ValidationText;

class UserController extends Controller
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
        $users=User::all();
        $websiteLang=$this->websiteLang;
        $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('admin.user.index',compact('users','websiteLang','confirmNotify'));
    }

    public function show($id){
        $user=User::find($id);
        if($user){
            $websiteLang=$this->websiteLang;
            return view('admin.user.show',compact('user','websiteLang'));
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('admin.user')->with($notification);
        }

    }

    public function destroy($id){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $user=User::where('id',$id)->first();
        $user_image=$user->image;
        $user_banner_image=$user->banner_image;

        Order::where('user_id',$id)->delete();
        Wishlist::where('user_id',$id)->delete();
        ListingReview::where('user_id',$id)->delete();

        $Listings=Listing::where('user_id',$id)->get();


        foreach($Listings as $listing){
            $old_images=$listing->listingImages;
            $old_logo=$listing->logo;
            $old_thumbnail=$listing->thumbnail_image;
            $listing_id=$listing->id;
            $listing->delete();

            ListingAminity::where('listing_id',$listing_id)->delete();
            ListingVideo::where('listing_id',$listing_id)->delete();
            Wishlist::where('listing_id',$listing_id)->delete();
            ListingReview::where('listing_id',$listing_id)->delete();
            ListingClaime::where('listing_id',$listing_id)->delete();

            if($old_images->count()>0){
                foreach($old_images as $old_image){
                    if(File::exists(public_path($old_image->image)))unlink(public_path($old_image->image));
                }
            }

            if(File::exists(public_path($old_logo)))unlink(public_path($old_logo));
            if(File::exists(public_path($old_thumbnail)))unlink(public_path($old_thumbnail));

            ListingImage::where('listing_id',$listing_id)->delete();
        }


        $user->delete();
        if($user_image){
            if(File::exists(public_path($user_image)))unlink(public_path($user_image));
        }
        if($user_banner_image){
            if(File::exists(public_path($user_banner_image)))unlink(public_path($user_banner_image));
        }



        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }


    public function changeStatus($id){
        $user=User::find($id);
        if($user->status==1){
            $user->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $user->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $user->save();
        return response()->json($message);

    }
}
