<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BannerImage;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use Image;
use File;
class BannerImageController extends Controller
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

    public function bannerImage(){
        $images=BannerImage::where('image_type',1)->get();
        $websiteLang=$this->websiteLang;
        return view('admin.banner-image.index',compact('images','websiteLang'));
    }
    public function BannerUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'image'=>'required',
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text
        ];

        $this->validate($request, $rules, $customMessages);

        $banner_image=BannerImage::find($id);
        if($banner_image){
            $old_image=$banner_image->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/website-images/'.$name;

            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($image_path));


            $banner_image->image=$image_path;
            $banner_image->save();
            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return back()->with($notification);
        }else{
            return back();
        }
    }


    public function LoginImage(){
        $images=BannerImage::where('image_type',2)->get();
        $websiteLang=$this->websiteLang;
        return view('admin.banner-image.login.index',compact('images','websiteLang'));
    }

    public function updateLogin(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'image'=>'required',
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text
        ];

        $this->validate($request, $rules, $customMessages);

        $login_image=BannerImage::find($id);
        if($login_image){
            $old_image=$login_image->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'login-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/website-images/'.$name;


            Image::make($image)
                ->resize(800,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(460,460)
                ->save(public_path($image_path));



            $login_image->image=$image_path;
            $login_image->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return back()->with($notification);
        }else{
            return back();
        }
    }

    public function profileImageIndex(){
        $images=BannerImage::where('image_type',4)->get();
        $websiteLang=$this->websiteLang;
        return view('admin.banner-image.profile.index',compact('images','websiteLang'));

    }

    public function updateProfileImage(Request $request,$id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $rules = [
            'image'=>'required',
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text
        ];

        $this->validate($request, $rules, $customMessages);

        $default_profile=BannerImage::find($id);
        if($default_profile){
            $old_image=$default_profile->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'login-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/website-images/'.$name;

            Image::make($image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($image_path));

            $default_profile->image=$image_path;
            $default_profile->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return back()->with($notification);
        }else{
            return back();
        }
    }

    public function bgIndex(){
        $images=BannerImage::where('image_type',3)->get();
        $websiteLang=$this->websiteLang;
        return view('admin.banner-image.bg-index',compact('images','websiteLang'));
    }

    public function updateBg(Request $request,$id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $rules = [
            'image'=>'required',
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text
        ];

        $this->validate($request, $rules, $customMessages);
        $bg_image=BannerImage::find($id);
        if($bg_image){
            $old_image=$bg_image->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'login-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/website-images/'.$name;

            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($image_path));

            $bg_image->image=$image_path;
            $bg_image->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return back()->with($notification);
        }else{
            return back();
        }
    }



}
