<?php
namespace App\Http\Controllers\Staff;
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
class StaffProfileController extends Controller
{
    public $notify;
    public $errorTexts;
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:staff');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function profile(){
        $admin=Auth::guard('staff')->user();
        $default_profile=BannerImage::find(15);
        $websiteLang=$this->websiteLang;
        return view('staff.profile.index',compact('admin','default_profile','websiteLang'));
    }

    public function updateProfile(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'confirmed',
        ]);

        $admin=Auth::guard('staff')->user();

        // inset user profile image
        if($request->file('image')){
            $old_image=$admin->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;

            Image::make($user_image)
                            ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($image_name));

            $admin->image=$image_name;
            $admin->save();
            if($old_image){
                if(File::exists(public_path($old_image)))unlink(public_path($old_image));
            }


        }

        if($request->password){
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->password=Hash::make($request->password);
            $admin->save();
        }else{
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->save();
        }


        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('staff.profile')->with($notification);


    }
}
