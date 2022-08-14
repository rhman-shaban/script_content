<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PackageSection;
use App\ManageText;
use Illuminate\Http\Request;


use App\NotificationText;
use App\ValidationText;
class PackageSectionController extends Controller
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
        $sections=PackageSection::all();
        $websiteLang=$this->websiteLang;
        return view('admin.package-section.index',compact('sections','websiteLang'));
    }



    public function updatePackageSection(Request $request,$id){

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

        $packageSection=PackageSection::find($id);
        $packageSection->icon=$request->icon;
        $packageSection->header=$request->header;
        $packageSection->description=$request->description;
        $packageSection->show_homepage=$request->show_homepage;
        $packageSection->content_quantity=$request->content_quantity;
        $packageSection->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.package-section.index')->with($notification);
    }


    public function updateSubscribeSection(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'header'=>'required',
            'description'=>'required',
            'show_homepage'=>'required',
        ];

        $customMessages = [
            'header.required' => $this->errorTexts->where('id',40)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $packageSection=PackageSection::find($id);
        $packageSection->header=$request->header;
        $packageSection->description=$request->description;
        $packageSection->show_homepage=$request->show_homepage;
        $packageSection->save();



        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.package-section.index')->with($notification);

    }

}
