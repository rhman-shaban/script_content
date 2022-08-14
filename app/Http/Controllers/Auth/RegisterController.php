<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\UserVerification;
use Str;
use Mail;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\ValidationText;
use App\NotificationText;
use App\Helpers\MailHelper;
class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public $notify;
    public $errorTexts;
    public function __construct()
    {
        $this->middleware('guest:web');
        $notify=NotificationText::all();
        $this->notify=$notify;


        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }


    public function userRegisterPage(){
        return redirect()->to('/invalid');
    }

    public function storeRegister(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:3',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' =>  $this->errorTexts->where('id',4)->first()->custom_text,
            'email.required' =>  $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' =>  $this->errorTexts->where('id',2)->first()->custom_text,
            'email.unique' =>  $this->errorTexts->where('id',3)->first()->custom_text,
            'password.required' =>  $this->errorTexts->where('id',12)->first()->custom_text,
            'password.confirmed' =>  $this->errorTexts->where('id',14)->first()->custom_text,
            'password.min' =>  $this->errorTexts->where('id',35)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);
        $user=User::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'email_verified_token'=>Str::random(100)
        ]);

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',5)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{user_name}}',$user->name,$message);

        Mail::to($user->email)->send(new UserVerification($user,$message,$subject));

        $notification=$this->notify->where('id',31)->first()->custom_text;
        return response()->json(['success'=>$notification]);

    }

    public function userVerify($token){
        $user=User::where('email_verified_token',$token)->first();
        $notify=NotificationText::first();
        if($user){
            $user->email_verified_token=null;
            $user->status=1;
            $user->email_verified=1;
            $user->save();
            $notification=array(
                'messege'=>$this->notify->where('id',4)->first()->custom_text,
                'alert-type'=>'success'
            );
            return  redirect()->route('home')->with($notification);
        }else{

            $notification=array(
                'messege'=>$this->notify->where('id',5)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->route('register')->with($notification);
        }
    }
}
