<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentAccount;
use App\ManageText;
use Illuminate\Http\Request;
use App\NotificationText;
use App\ValidationText;
use App\Razorpay;
use App\Flutterwave;
use Image;
use File;

use App\PaystackAndMollie;
use App\Instamojo;
use App\Currency;
use App\CurrencyCountry;
use App\Setting;
use App\PaymongoPayment;

class PaymentAccountController extends Controller
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

    public function index()
    {   $paymentAccount=PaymentAccount::first();
        $websiteLang=$this->websiteLang;
        if($paymentAccount){
            $razorpay=Razorpay::first();
            $flutterwave = Flutterwave::first();

            $paystack = PaystackAndMollie::first();
            $mollie = $paystack;
            $countires = CurrencyCountry::orderBy('name','asc')->get();
            $currencies = Currency::orderBy('name','asc')->get();
            $setting = Setting::first();
            $instamojo = Instamojo::first();
            $paymongo = PaymongoPayment::first();
            return view('admin.payment-account.edit',compact('paymentAccount','websiteLang','razorpay','flutterwave','paystack','countires','currencies','setting','mollie','instamojo','paymongo'));
        }

    }

    public function update(Request $request, PaymentAccount $paymentAccount)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'account_mode'=>'required',
            'paypal_client_id'=>'required',
            'paypal_secret'=>'required',
            'paypal_currency_rate' => 'required|numeric',
            'paypal_country_code' => 'required',
            'paypal_currency_code' => 'required'
        ];

        $customMessages = [
            'account_mode.required' => $this->errorTexts->where('id',66)->first()->custom_text,
            'paypal_client_id.required' => $this->errorTexts->where('id',67)->first()->custom_text,
            'paypal_secret.required' => $this->errorTexts->where('id',68)->first()->custom_text,
            'paypal_currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'paypal_currency_code.required' => $this->errorTexts->where('id',118)->first()->custom_text,
            'paypal_country_code.required' => $this->errorTexts->where('id',117)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $paymentAccount->account_mode=$request->account_mode;
        $paymentAccount->paypal_client_id=$request->paypal_client_id;
        $paymentAccount->paypal_secret=$request->paypal_secret;
        $paymentAccount->paypal_status=$request->paypal_status;
        $paymentAccount->paypal_currency_code=$request->paypal_currency_code;
        $paymentAccount->paypal_country_code=$request->paypal_country_code;
        $paymentAccount->paypal_currency_rate=$request->paypal_currency_rate;
        $paymentAccount->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.payment-account.index')->with($notification);


    }


    public function razorpayUpdate(Request $request,$id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $valid_lang=ValidationText::all();
        $rules = [
            'razorpay_key'=>'required',
            'razorpay_secret'=>'required',
            'name'=>'required',
            'description'=>'required',
            'currency_rate'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
        ];
        $customMessages = [
            'razorpay_key.required' => $this->errorTexts->where('id',107)->first()->custom_text,
            'razorpay_secret.required' => $this->errorTexts->where('id',108)->first()->custom_text,
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'currency_code.required' => $this->errorTexts->where('id',118)->first()->custom_text,
            'country_code.required' => $this->errorTexts->where('id',117)->first()->custom_text,
        ];
        $this->validate($request, $rules,$customMessages);

        $razorpay=Razorpay::find($id);
        $razorpay->razorpay_key=$request->razorpay_key;
        $razorpay->secret_key=$request->razorpay_secret;
        $razorpay->name=$request->name;
        $razorpay->description=$request->description;
        $razorpay->theme_color=$request->theme_color;
        $razorpay->razorpay_status=$request->razorpay_status;
        $razorpay->currency_rate=$request->currency_rate;
        $razorpay->country_code=$request->country_code;
        $razorpay->currency_code=$request->currency_code;
        $razorpay->save();

        if($request->image){
            $old_image=$razorpay->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'razorpay-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;
            Image::make($image)
                ->save(public_path().'/'.$image_name);
            $razorpay->image=$image_name;
            $razorpay->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }



        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.payment-account.index')->with($notification);

    }


    public function stripeUpdate(Request $request , $id){
         // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'stripe_key'=>'required',
            'stripe_secret'=>'required',
            'stripe_currency_rate' => 'required|numeric',
            'stripe_country_code' => 'required',
            'stripe_currency_code' => 'required'
        ];

        $customMessages = [
            'stripe_key.required' => $this->errorTexts->where('id',69)->first()->custom_text,
            'stripe_secret.required' => $this->errorTexts->where('id',70)->first()->custom_text,
            'stripe_currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'stripe_currency_code.required' => $this->errorTexts->where('id',118)->first()->custom_text,
            'stripe_country_code.required' => $this->errorTexts->where('id',117)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);
        $paymentAccount=PaymentAccount::find($id);
        $paymentAccount->stripe_key=$request->stripe_key;
        $paymentAccount->stripe_secret=$request->stripe_secret;
        $paymentAccount->stripe_status=$request->stripe_status;
        $paymentAccount->stripe_country_code=$request->stripe_country_code;
        $paymentAccount->stripe_currency_code=$request->stripe_currency_code;
        $paymentAccount->stripe_currency_rate=$request->stripe_currency_rate;
        $paymentAccount->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function bankUpdate(Request $request,$id){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'bank_account'=>'required',
            'bank_status'=>'required',
        ];

        $customMessages = [
            'bank_account.required' => $this->errorTexts->where('id',109)->first()->custom_text,
        ];

        $this->validate($request, $rules,$customMessages);

        $paymentAccount=PaymentAccount::find($id);
        $paymentAccount->bank_account=$request->bank_account;
        $paymentAccount->bank_status=$request->bank_status;
        $paymentAccount->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.payment-account.index')->with($notification);
    }

    public function flutterwaveUpdate(Request $request, $id){
       // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        // $valid_lang=ValidationText::all();
        $rules = [
            'public_key'=>'required',
            'secret_key'=>'required',
            'title'=>'required',
            'status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];
        $customMessages = [
            'public_key.required' => $this->errorTexts->where('id',69)->first()->custom_text,
            'secret_key.required' => $this->errorTexts->where('id',70)->first()->custom_text,
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
            'currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'currency_code.required' => $this->errorTexts->where('id',118)->first()->custom_text,
            'country_code.required' => $this->errorTexts->where('id',117)->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        $flutterwave = Flutterwave::find($id);
        $flutterwave->public_key = $request->public_key;
        $flutterwave->secret_key = $request->secret_key;
        $flutterwave->title = $request->title;
        $flutterwave->status = $request->status;
        $flutterwave->country_code=$request->country_code;
        $flutterwave->currency_code=$request->currency_code;
        $flutterwave->currency_rate=$request->currency_rate;
        $flutterwave->save();

        if($request->image){
            $old_image=$flutterwave->logo;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'flutterwave-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;
            Image::make($image)
                ->save(public_path().'/'.$image_name);
            $flutterwave->logo=$image_name;
            $flutterwave->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }


        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function paystackUpdate(Request $request, $id){

       // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'paystack_public_key' => $request->status ? 'required' : '',
            'paystack_secret_key' => $request->status ? 'required' : '',
            'paystack_currency_rate' => 'required|numeric',
            'paystack_currency_name' => $request->status ? 'required' : '',
            'paystack_country_name' => $request->status ? 'required' : ''
        ];

        $customMessages = [
            'paystack_public_key.required' => $this->errorTexts->where('id',115)->first()->custom_text,
            'paystack_secret_key.required' => $this->errorTexts->where('id',116)->first()->custom_text,
            'paystack_currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'paystack_currency_name.required' => $this->errorTexts->where('id',118)->first()->custom_text,
            'paystack_country_name.required' => $this->errorTexts->where('id',117)->first()->custom_text,
        ];
        $this->validate($request, $rules,$customMessages);

        $paystact = PaystackAndMollie::first();
        $paystact->paystack_public_key = $request->paystack_public_key;
        $paystact->paystack_secret_key = $request->paystack_secret_key;
        $paystact->paystack_currency_code = $request->paystack_currency_name;
        $paystact->paystack_country_code = $request->paystack_country_name;
        $paystact->paystack_currency_rate = $request->paystack_currency_rate;
        $paystact->paystack_status = $request->status ? 1 : 0;
        $paystact->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function updateMollie(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'mollie_key' => $request->status ? 'required' : '',
            'mollie_currency_rate' => 'required|numeric',
            'mollie_country_name' => $request->status ? 'required' : '',
            'mollie_currency_name' => $request->status ? 'required' : ''
        ];

        $customMessages = [
            'mollie_key.required' => $this->errorTexts->where('id',121)->first()->custom_text,
            'mollie_currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'mollie_currency_name.required' => $this->errorTexts->where('id',118)->first()->custom_text,
            'mollie_country_name.required' => $this->errorTexts->where('id',117)->first()->custom_text,
        ];
        $this->validate($request, $rules,$customMessages);

        $mollie = PaystackAndMollie::first();
        $mollie->mollie_key = $request->mollie_key;
        $mollie->mollie_currency_rate = $request->mollie_currency_rate;
        $mollie->mollie_currency_code = $request->mollie_currency_name;
        $mollie->mollie_country_code = $request->mollie_country_name;
        $mollie->mollie_status = $request->status ? 1 : 0;
        $mollie->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function updateInstamojo(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'account_mode' => $request->status ? 'required' : '',
            'api_key' => $request->status ? 'required' : '',
            'auth_token' => $request->status ? 'required' : '',
            'currency_rate' =>'required|numeric',
        ];
        $customMessages = [
            'api_key.required' => $this->errorTexts->where('id',122)->first()->custom_text,
            'auth_token.required' => $this->errorTexts->where('id',123)->first()->custom_text,
            'currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,


        ];
        $this->validate($request, $rules,$customMessages);

        $instamojo = Instamojo::first();
        $instamojo->account_mode = $request->account_mode;
        $instamojo->api_key = $request->api_key;
        $instamojo->auth_token = $request->auth_token;
        $instamojo->currency_rate = $request->currency_rate;
        $instamojo->status = $request->status ? 1 : 0;
        $instamojo->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.payment-account.index')->with($notification);
    }

    public function updatePaymongo(Request $request, $id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        // $valid_lang=ValidationText::all();
        $rules = [
            'public_key'=>'required',
            'secret_key'=>'required',
            'status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];
        $customMessages = [
            'public_key.required' => $this->errorTexts->where('id',115)->first()->custom_text,
            'secret_key.required' => $this->errorTexts->where('id',116)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
            'currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'currency_code.required' => $this->errorTexts->where('id',118)->first()->custom_text,
            'country_code.required' => $this->errorTexts->where('id',117)->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        $paymongo = PaymongoPayment::find($id);
        $paymongo->public_key = $request->public_key;
        $paymongo->secret_key = $request->secret_key;
        $paymongo->status = $request->status;
        $paymongo->country_code=$request->country_code;
        $paymongo->currency_code=$request->currency_code;
        $paymongo->currency_rate=$request->currency_rate;
        $paymongo->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.payment-account.index')->with($notification);
    }

}
