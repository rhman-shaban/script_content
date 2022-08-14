<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
class AboutController extends Controller
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
        $about=About::first();
        $websiteLang=$this->websiteLang;
        return view('admin.about.edit',compact('about','websiteLang'));

    }


    public function update(Request $request, About $about)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'video_link'=>'required',
            'description'=>'required',

        ];

        $customMessages = [
            'video_link.required' => $this->errorTexts->where('id',37)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        //    manage background image
        if($request->file('image')){
            $old_bg_image=$about->background_image;
            $background_image=$request->image;
            $extention=$background_image->getClientOriginalExtension();
            $background_image_name= 'about-background-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $background_image_name='uploads/website-images/'.$background_image_name;

            Image::make($background_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(530,530)
                ->save(public_path($background_image_name));


            $about->background_image=$background_image_name;
            $about->save();
            if(File::exists(public_path($old_bg_image)))unlink(public_path($old_bg_image));

        }

        $about->video_link=$request->video_link;
        $about->description=$request->description;
        $about->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.about.index')->with($notification);

    }




}
