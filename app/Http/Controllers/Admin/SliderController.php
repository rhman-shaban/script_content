<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;

use App\NotificationText;
use App\ValidationText;
class SliderController extends Controller
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
        $slider=Slider::first();
        $websiteLang=ManageText::all();
        return view('admin.slider.index',compact('slider','websiteLang'));
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
            'image'=>'required'
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $slider=Slider::find($id);
        $old_slider=$slider->image;
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'home-page-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;


        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($image_path));

        $slider->image=$image_path;
        $slider->save();

        if(File::exists(public_path($old_slider)))unlink(public_path($old_slider));



        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }



}
