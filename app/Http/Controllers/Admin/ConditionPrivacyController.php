<?php

namespace App\Http\Controllers\Admin;

use App\ConditionPrivacy;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConditionPrivacyController extends Controller
{
    public $notify;
    public $errorTexts;


    public function __construct()
    {
        $this->middleware('auth:admin');

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function index()
    {

        $conditionPrivacy=ConditionPrivacy::first();
        $websiteLang=ManageText::all();
        if($conditionPrivacy){
            return view('admin.terms-privacy.edit',compact('conditionPrivacy','websiteLang'));
        }else{
            return view('admin.terms-privacy.create',compact('websiteLang'));
        }

    }


    public function store(Request $request)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'terms_condition'=>'required',
            'privacy_policy'=>'required',
        ];

        $customMessages = [
            'terms_condition.required' => $this->errorTexts->where('id',47)->first()->custom_text,
            'privacy_policy.required' => $this->errorTexts->where('id',48)->first()->custom_text,


        ];

        $this->validate($request, $rules, $customMessages);

        ConditionPrivacy::create([
            'terms_condition'=>$request->terms_condition,
            'privacy_policy'=>$request->privacy_policy
        ]);

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.terms-privacy.index')->with($notification);
    }




    public function update(Request $request, $id)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'terms_condition'=>'required',
            'privacy_policy'=>'required',
        ];

        $customMessages = [
            'terms_condition.required' => $this->errorTexts->where('id',47)->first()->custom_text,
            'privacy_policy.required' => $this->errorTexts->where('id',48)->first()->custom_text,


        ];

        $this->validate($request, $rules, $customMessages);

        ConditionPrivacy::where('id',$id)->update([
            'terms_condition'=>$request->terms_condition,
            'privacy_policy'=>$request->privacy_policy
        ]);

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.terms-privacy.index')->with($notification);
    }

}
