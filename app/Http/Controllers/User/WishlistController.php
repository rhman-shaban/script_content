<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use App\NotificationText;
use App\ManageText;
use App\Navigation;
use App\Day;
use Auth;
class WishlistController extends Controller
{
    public $notify;
    public $websiteLang;
    public function __construct()
    {
        $this->middleware('auth:web');
        $notify=NotificationText::all();
        $this->notify=$notify;

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;
    }

    public function wishlist(){
        $user=Auth::guard('web')->user();
        $wishlists=Wishlist::with('listing')->where('user_id',$user->id)->get();
        $days=Day::all();

        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.profile.wishlist',compact('wishlists','days','websiteLang','menus'));
    }

    public function create($id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $user=Auth::guard('web')->user();
        $isExist=Wishlist::where(['listing_id'=>$id, 'user_id'=>$user->id])->first();
        if(!$isExist){
            $wishlist=new Wishlist();
            $wishlist->user_id=$user->id;
            $wishlist->listing_id=$id;
            $wishlist->save();

            $notification=array(
                'messege'=>$this->notify->where('id',22)->first()->custom_text,
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',23)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $wishlist=Wishlist::find($id);
        $wishlist->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
