<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Hash;
use App\BannerImage;
use App\ValidationText;
use App\NotificationText;
use App\ManageText;
class StaffLoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::STAFF;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:staff')->except('staffLogout');
    }


    public function staffLoginForm(){
        $image=BannerImage::find(8);
        $websiteLang=ManageText::all();
        return view('staff.auth.login',compact('image','websiteLang'));
    }

    public function storeLoginInfo(Request $request){
        $errorTexts=ValidationText::all();
        $rules = [
            'email'=>'required|email',
            'password'=>'required',
        ];

        $customMessages = [
            'email.required' => $errorTexts->where('id',1)->first()->custom_text,
            'email.email' => $errorTexts->where('id',2)->first()->custom_text,
            'password.required' => $errorTexts->where('id',12)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $notify=NotificationText::all();
        $isAdmin=Admin::where('email',$request->email)->first();
        if($isAdmin){
            if($isAdmin->status==1){
                if($isAdmin->admin_type==2){
                    if(Hash::check($request->password,$isAdmin->password)){
                        if(Auth::guard('staff')->attempt($credential,$request->remember)){
                            $notification=$notify->where('id',26)->first()->custom_text;

                            return response()->json(['success'=>$notification]);


                        }

                        $notification=$notify->where('id',7)->first()->custom_text;

                        return response()->json(['error'=>$notification]);
                    }else{
                        $notification=$notify->where('id',28)->first()->custom_text;

                        return response()->json(['error'=>$notification]);
                    }

                }else{
                    $notification=$notify->where('id',7)->first()->custom_text;

                    return response()->json(['error'=>$notification]);
                }


            }else{
                $notification=$notify->where('id',29)->first()->custom_text;

                return response()->json(['error'=>$notification]);
            }

        }else{
            $notification=$notify->where('id',28)->first()->custom_text;

            return response()->json(['error'=>$notification]);
        }



    }

    public function staffLogout(){
        $notify=NotificationText::all();
        Auth::guard('staff')->logout();
        $notification=array(
            'messege'=>$notify->where('id',30)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('staff.login')->with($notification);
    }

}
