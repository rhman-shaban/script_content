<?php

namespace App\Http\Controllers\Admin;

use App\HomeSection;
use App\ManageText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\NotificationText;
use App\ValidationText;
class HomeSectionController extends Controller
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
        $sections=HomeSection::all();
        $websiteLang=$this->websiteLang;
        return view('admin.home-section.index',compact('sections','websiteLang'));
    }




    public function edit(HomeSection $homeSection)
    {
        $websiteLang=$this->websiteLang;
        return view('admin.home-section.edit',compact('homeSection','websiteLang'));
    }


    public function update(Request $request, HomeSection $homeSection)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($homeSection->id==1 || $homeSection->id==9){

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

            $homeSection->header=$request->header;
            $homeSection->description=$request->description;
            $homeSection->show_homepage=$request->show_homepage;
            $homeSection->save();

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->route('admin.home-section.index')->with($notification);
        }else if($homeSection->id==3){
            $rules = [
                'header'=>'required',
                'sort_title'=>'required',
                'show_homepage'=>'required',

            ];

            $customMessages = [
                'header.required' => $this->errorTexts->where('id',40)->first()->custom_text,
                'sort_title.required' => $this->errorTexts->where('id',38)->first()->custom_text,
                'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
            ];

            $this->validate($request, $rules, $customMessages);

            $homeSection->header=$request->header;
            $homeSection->description=$request->sort_title;
            $homeSection->show_homepage=$request->show_homepage;
            $homeSection->save();

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->route('admin.home-section.index')->with($notification);
        }else{

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

            $homeSection->icon=$request->icon;
            $homeSection->header=$request->header;
            $homeSection->description=$request->description;
            $homeSection->show_homepage=$request->show_homepage;
            $homeSection->content_quantity=$request->content_quantity;
            $homeSection->save();

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->route('admin.home-section.index')->with($notification);
        }

    }


    public function updateBannerSection(Request $request,$id){
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

        $homeSection=HomeSection::find($id);
        $homeSection->header=$request->header;
        $homeSection->description=$request->description;
        $homeSection->show_homepage=$request->show_homepage;
        $homeSection->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.home-section.index')->with($notification);
    }



    public function updateFeatureSection(Request $request,$id){
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

        $homeSection=HomeSection::find($id);

        $homeSection->icon=$request->icon;
        $homeSection->header=$request->header;
        $homeSection->description=$request->description;
        $homeSection->show_homepage=$request->show_homepage;
        $homeSection->content_quantity=$request->content_quantity;
        $homeSection->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.home-section.index')->with($notification);
    }


    public function updateOverviewSection(Request $request,$id){


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

        $homeSection=HomeSection::find($id);
        $homeSection->header=$request->header;
        $homeSection->description=$request->description;
        $homeSection->icon=$request->icon;
        $homeSection->short_title=$request->sort_title;
        $homeSection->show_homepage=$request->show_homepage;
        $homeSection->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.home-section.index')->with($notification);
    }


    public function updateBannerCategorySection(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $homeSection=HomeSection::find($id);
        $homeSection->show_homepage=$request->show_homepage;
        $homeSection->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.home-section.index')->with($notification);
    }


    public function destroy(HomeSection $homeSection)
    {

    }


    public function changeStatus($id){
        $section=HomeSection::find($id);
        if($section->show_homepage==1){
            $section->show_homepage=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $section->show_homepage=1;
            $message=$this->notify->where('id',13)->first()->custom_text;
        }
        $section->save();
        return response()->json($message);

    }
}
