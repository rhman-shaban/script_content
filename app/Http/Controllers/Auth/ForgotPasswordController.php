<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Mail\ForgetPassword;
use Str;
use Mail;
use Hash;
use Auth;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\NotificationText;
use App\ValidationText;
use App\Helpers\MailHelper;
class ForgotPasswordController extends Controller
{

    public $notify;
    public $errorTexts;
    public $websiteLang;
    public function __construct()
    {
        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;
    }

   public function sendForgetEmail(Request $request){

        $rules = [
            'email'=>'required|email',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'email.required' =>  $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' =>  $this->errorTexts->where('id',2)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $user=User::where('email',$request->email)->first();

        MailHelper::setMailConfig();
        if($user){
            $user->forget_password_token=Str::random(100);
            $user->save();
            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$user->name,$message);
            Mail::to($user->email)->send(new ForgetPassword($user,$message,$subject));
            $notification=$this->notify->where('id',24)->first()->custom_text;
            return response()->json(['success'=>$notification]);

        }else{
            $notification=$this->notify->where('id',25)->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }

   }

   public function resetPassword($token){
        $user=User::where('forget_password_token',$token)->first();
        if($user){
            $setting=Setting::first();
            $image=BannerImage::find(11);
            $websiteLang=$this->websiteLang;
            $menus=Navigation::all();
            return view('user.reset-password',compact('user','token','setting','image','websiteLang','menus'));
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',5)->first()->custom_text,
                'alert-type'=>'error'
            );

            return Redirect()->route('home')->with($notification);
        }
   }


   public function storeResetData(Request $request,$token){

        $rules = [
            'email'=>'required|email',
            'password'=>'required|confirmed|min:3',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'email.required' =>  $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' =>  $this->errorTexts->where('id',2)->first()->custom_text,
            'password.required' =>  $this->errorTexts->where('id',12)->first()->custom_text,
            'password.confirmed' =>  $this->errorTexts->where('id',14)->first()->custom_text,
            'password.min' =>  $this->errorTexts->where('id',35)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $user=User::where('forget_password_token',$token)->first();
        if($user->email==$request->email){
            $user->password=Hash::make($request->password);
            $user->forget_password_token=null;
            $user->save();

            $notification=array(
                'messege'=>$this->notify->where('id',13)->first()->custom_text,
                'alert-type'=>'success'
            );
            return Redirect()->route('home')->with($notification);

        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',25)->first()->custom_text,
                'alert-type'=>'error'
            );

            return back()->with($notification);
        }
   }


}
