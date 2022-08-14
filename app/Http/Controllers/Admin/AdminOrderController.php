<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\ContactMessage;
use App\Setting;
use App\ManageText;
use App\NotificationText;
use App\EmailTemplate;
use App\ListingPackage;
use App\Listing;
use App\Helpers\MailHelper;
use App\Mail\PaymentAccept;
use Mail;
class AdminOrderController extends Controller
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
        $orders=Order::where('payment_status',1)->orderBy('id','desc')->get();
        $websiteLang=$this->websiteLang;
        $currency=Setting::first();
        $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('admin.order.index',compact('orders','websiteLang','currency','confirmNotify'));
    }

    public function pendingOrder(){
        $orders=Order::where('payment_status',0)->orderBy('id','desc')->get();
        $websiteLang=$this->websiteLang;
        $currency=Setting::first();
        $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('admin.order.pending-order',compact('orders','websiteLang','currency','confirmNotify'));
    }

    public function pendingPayment($id){
        $order=Order::find($id);
        $websiteLang=$this->websiteLang;
        if($order){
            $currency=Setting::first();
            return view('admin.order.payment-accept',compact('order','websiteLang','currency'));
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->route('admin.order')->with($notification);
        }
    }


    public function paymentAccept($id){
        $order=Order::find($id);
        $user=$order->user;
        // $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);
        $order->payment_status=1;
        $order->status=1;
        $order->save();
        $package=ListingPackage::find($order->listing_package_id);
        // active and  in-active minimum limit listing
        $userListings=Listing::where('user_id',$user->id)->orderBy('id','desc')->get();
        if($userListings->count() !=0){
            if($package->number_of_listing !=-1){
                foreach($userListings as $index => $listing){
                    if(++$index <= $package->number_of_listing){
                        $listing->status=1;
                        $listing->save();
                    }else{
                        $listing->status=0;
                        $listing->save();
                    }
                }
            }elseif($package->number_of_listing ==-1){
                foreach($userListings as $index => $listing){
                    $listing->status=1;
                    $listing->save();
                }
            }
        }
        // end inactive

        // setup expired date
        if($userListings->count() != 0){
            foreach($userListings as $index => $listing){
                $listing->expired_date=$order->expired_date;
                $listing->save();
            }
        }



        MailHelper::setMailConfig();
        $template=EmailTemplate::where('id',8)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{name}}',$user->name,$message);
        Mail::to($user->email)->send(new PaymentAccept($message,$subject));

        $notification=array(
            'messege'=>$this->notify->where('id',49)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.pending-order')->with($notification);
    }

    public function show($id){
        $order=Order::find($id);
        $websiteLang=$this->websiteLang;
        if($order){
            $currency=Setting::first();
            return view('admin.order.show',compact('order','websiteLang','currency'));
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->route('admin.order')->with($notification);
        }
    }


    public function destroy($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $order=Order::find($id);
        if($order){
            $order->delete();
            $notification=array(
                'messege'=>$this->notify->where('id',10)->first()->custom_text,
                'alert-type'=>'success'
            );
            return redirect()->route('admin.order')->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->route('admin.order')->with($notification);
        }
    }







}
