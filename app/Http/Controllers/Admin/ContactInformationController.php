<?php

namespace App\Http\Controllers\Admin;

use App\ContactInformation;
use App\ContactUs;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
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
    {
        $contact=ContactInformation::first();
        $contact_us=ContactUs::first();
        $websiteLang=$this->websiteLang;
        return view('admin.contact.contact-information.edit',compact('contact','contact_us','websiteLang'));
    }



    public function update(Request $request, ContactInformation $contactInformation)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'header'=>'required',
            'address'=>'required',
            'about'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'map_embed_code'=>'required',
            'copyright'=>'required',
        ];

        $customMessages = [
            'header.required' => $this->errorTexts->where('id',40)->first()->custom_text,
            'address.required' => $this->errorTexts->where('id',22)->first()->custom_text,
            'about.required' => $this->errorTexts->where('id',11)->first()->custom_text,
            'phone.required' => $this->errorTexts->where('id',5)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'map_embed_code.required' => $this->errorTexts->where('id',49)->first()->custom_text,
            'copyright.required' => $this->errorTexts->where('id',50)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        ContactInformation::where('id',$contactInformation->id)->update([
            'header'=>$request->header,
            'address'=>$request->address,
            'about'=>$request->about,
            'phones'=>$request->phone,
            'emails'=>$request->email,
            'map_embed_code'=>$request->map_embed_code,
            'copyright'=>$request->copyright,
        ]);

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contact-information.index')->with($notification);
    }



    public function topbarContact(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $contact=ContactUs::find($id);
        $contact->topbar_phone=$request->topbar_phone;
        $contact->topbar_email=$request->topbar_email;
        $contact->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contact-information.index')->with($notification);
    }

    public function footerContact(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $contact=ContactUs::find($id);
        $contact->footer_phone=$request->footer_phone;
        $contact->footer_email=$request->footer_email;
        $contact->footer_address=$request->footer_address;
        $contact->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contact-information.index')->with($notification);
    }

    public function socialLink(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $contact=ContactUs::find($id);
        $contact->facebook=$request->facebook;
        $contact->twitter=$request->twitter;
        $contact->youtube=$request->youtube;
        $contact->linkedin=$request->linkedin;
        $contact->instagram=$request->instagram;
        $contact->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contact-information.index')->with($notification);
    }



}
