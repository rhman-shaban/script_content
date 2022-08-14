<?php

namespace App\Http\Controllers\Admin;

use App\AboutSection;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
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
        $sections=AboutSection::all();
        $websiteLang=$this->websiteLang;
        return view('admin.about.about-section.index',compact('sections','websiteLang'));
    }




    public function sectionAboutUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'icon'=>'required',
            'header'=>'required',
            'description'=>'required',
            'show_homepage'=>'required',

        ];

        $customMessages = [
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'header.required' => $this->errorTexts->where('id',40)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $aboutSection=AboutSection::find($id);

        $aboutSection->icon=$request->icon;
        $aboutSection->header=$request->header;
        $aboutSection->description=$request->description;
        $aboutSection->show_homepage=$request->show_homepage;
        $aboutSection->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.about-section.index')->with($notification);
    }


    public function sectionFeatureUpdate(Request $request,$id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'icon'=>'required',
            'header'=>'required',
            'description'=>'required',
            'show_homepage'=>'required',
            'content_quantity'=>'required',

        ];

        $customMessages = [
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'header.required' => $this->errorTexts->where('id',40)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
            'content_quantity.required' => $this->errorTexts->where('id',38)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $aboutSection=AboutSection::find($id);

        $aboutSection->icon=$request->icon;
        $aboutSection->header=$request->header;
        $aboutSection->description=$request->description;
        $aboutSection->show_homepage=$request->show_homepage;
        $aboutSection->content_quantity=$request->content_quantity;
        $aboutSection->save();


        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.about-section.index')->with($notification);
    }


    public function sectionOverviewUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'sort_title'=>'required',
            'icon'=>'required',
            'header'=>'required',
            'description'=>'required',
            'show_homepage'=>'required',
        ];

        $customMessages = [
            'sort_title.required' => $this->errorTexts->where('id',38)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'header.required' => $this->errorTexts->where('id',40)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
        ];


        $this->validate($request, $rules, $customMessages);

        $aboutSection=AboutSection::find($id);
        $aboutSection->header=$request->header;
        $aboutSection->description=$request->description;
        $aboutSection->icon=$request->icon;
        $aboutSection->short_title=$request->sort_title;
        $aboutSection->show_homepage=$request->show_homepage;
        $aboutSection->save();


        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.about-section.index')->with($notification);
    }


    public function sectionPartnerUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'content_quantity'=>'required',
            'show_homepage'=>'required',

        ];

        $customMessages = [
            'content_quantity.required' => $this->errorTexts->where('id',38)->first()->custom_text,
            'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $aboutSection=AboutSection::find($id);
        $aboutSection->content_quantity=$request->content_quantity;
        $aboutSection->show_homepage=$request->show_homepage;
        $aboutSection->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.about-section.index')->with($notification);
    }



}
