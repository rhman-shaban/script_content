<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\BannerImage;
use App\ManageText;
use Image;
use Hash;
use File;
use Str;

use App\NotificationText;
use App\ValidationText;

class ProfileController extends Controller
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

    public function profile(){
        $admin=Auth::guard('admin')->user();
        $default_profile=BannerImage::find(15);
        $websiteLang=$this->websiteLang;
        $image=BannerImage::find(18);
        return view('admin.profile.index',compact('admin','default_profile','websiteLang','image'));
    }

    public function updateProfile(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'name'=>'required',
            'email'=>'required',
            'password'=>'confirmed',
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',3)->first()->custom_text,
            'password.confirmed' => $this->errorTexts->where('id',14)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);



        $admin=Auth::guard('admin')->user();

        // inset user profile image
        if($request->file('image')){
            $old_image=$admin->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->crop(400,400)->save(public_path($image_name));

            $admin->image=$image_name;
            $admin->save();
            if($old_image){
                if(File::exists(public_path($old_image)))unlink(public_path($old_image));
            }

        }

        if($request->file('banner_image')){
            $old_banner_image=$admin->banner_image;
            $banner_image=$request->banner_image;
            $banner_ext=$banner_image->getClientOriginalExtension();
            $banner_name= 'listing-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$banner_ext;
            $banner_path='uploads/website-images/'.$banner_name;

            Image::make($banner_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($banner_path));

            $admin->banner_image=$banner_path;
            $admin->save();
            if($old_banner_image){
                if(File::exists(public_path($old_banner_image)))unlink(public_path($old_banner_image));
            }

        }

        if($request->password){
            $admin->name=$request->name;
            $admin->slug=Str::slug($request->name);
            $admin->email=$request->email;
            $admin->password=Hash::make($request->password);

            $admin->address=$request->address;
            $admin->email=$request->email;
            $admin->phone=$request->phone;
            $admin->website=$request->website;
            $admin->facebook=$request->facebook;
            $admin->twitter=$request->twitter;
            $admin->linkedin=$request->linkedin;
            $admin->whatsapp=$request->whatsapp;
            $admin->instagram=$request->instagram;
            $admin->pinterest=$request->pinterest;
            $admin->youtube=$request->youtube;
            $admin->about=$request->about;
            $admin->save();
        }else{
            $admin->name=$request->name;
            $admin->slug=Str::slug($request->name);
            $admin->email=$request->email;
            $admin->address=$request->address;
            $admin->email=$request->email;
            $admin->phone=$request->phone;
            $admin->website=$request->website;
            $admin->facebook=$request->facebook;
            $admin->twitter=$request->twitter;
            $admin->linkedin=$request->linkedin;
            $admin->whatsapp=$request->whatsapp;
            $admin->instagram=$request->instagram;
            $admin->pinterest=$request->pinterest;
            $admin->youtube=$request->youtube;
            $admin->about=$request->about;
            $admin->save();
        }


        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.profile')->with($notification);


    }
}
