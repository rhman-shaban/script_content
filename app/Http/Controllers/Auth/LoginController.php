<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;



class LoginController extends Controller
{

    public $notify;
    public $errorTexts;

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:web')->except('userLogout');
        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function userLoginPage(){
        return redirect()->to('/invalid');
    }

    public function storeLogin(Request $request){
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [

            'email.required' =>  $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' =>  $this->errorTexts->where('id',2)->first()->custom_text,
            'password.required' =>  $this->errorTexts->where('id',12)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);
        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $user=User::where('email',$request->email)->first();
        if($user){
            if($user->status==1){
                if(Hash::check($request->password,$user->password)){
                    if(Auth::guard('web')->attempt($credential,$request->remember)){
                        $notification=$this->notify->where('id',26)->first()->custom_text;
                        return response()->json(['success'=>$notification]);
                    }
                }else{
                    $notification=$this->notify->where('id',28)->first()->custom_text;

                    return response()->json(['error'=>$notification]);
                }

            }else{
                $notification=$this->notify->where('id',29)->first()->custom_text;

                return response()->json(['error'=>$notification]);
            }
        }else{
            $notification=$this->notify->where('id',25)->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        $notification=array(
            'messege'=>$this->notify->where('id',30)->first()->custom_text,
            'alert-type'=>'success'
        );
        return Redirect()->route('home')->with($notification);
    }
}
