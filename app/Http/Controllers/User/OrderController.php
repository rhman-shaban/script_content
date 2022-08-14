<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Navigation;
use App\ManageText;
use App\PaymentAccount;
use App\BannerImage;
use App\NotificationText;
use App\Setting;
use Auth;
use Illuminate\Pagination\Paginator;
class OrderController extends Controller
{

    public $websiteLang;
    public $notify;
    public function __construct()
    {
        $this->middleware('auth:web');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $this->middleware('auth:web');
        $notify=NotificationText::all();
        $this->notify=$notify;
    }

    public function index(){
        Paginator::useBootstrap();
        $user=Auth::guard('web')->user();
        $orders=Order::where(['user_id'=>$user->id])->orderBy('id','desc')->paginate(10);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        $currency=Setting::first();
        return view('user.profile.order.index',compact('orders','websiteLang','menus','currency'));
    }


    public function show($id){
        $user=Auth::guard('web')->user();
        $order=Order::where(['user_id'=>$user->id,'id'=>$id])->first();
        if($order){
            $websiteLang=$this->websiteLang;
            $menus=Navigation::all();
            $currency=Setting::first();
            $logo=Setting::first();
            return view('user.profile.order.show',compact('order','websiteLang','menus','currency','logo'));
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }

    }
}
