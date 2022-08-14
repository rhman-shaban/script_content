<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Listing;
use App\ListingReview;
use App\Wishlist;
use App\ManageText;
use App\Order;
use App\Setting;
use Auth;
class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function dashboard(){
        $user=Auth::guard('web')->user();
        $listings=Listing::where(['user_id'=>$user->id,'status'=>1])->get();
        $wishlists=Wishlist::where('user_id',$user->id)->get();

        $reviews=0;
        foreach($listings as $listing){
            $qty=$listing->reviews->count();
            $reviews +=$qty;
        }

        $websiteLang=ManageText::all();
        $currency=Setting::first();
        $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->first();
        return view('user.profile.dashboard',compact('listings','wishlists','reviews','websiteLang','activeOrder','currency'));
    }
}
