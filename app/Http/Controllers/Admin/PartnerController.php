<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Partner;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;


use App\NotificationText;
use App\ValidationText;
class PartnerController extends Controller
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
        $partners=Partner::all();
        $websiteLang=$this->websiteLang;
        return view('admin.partner.index',compact('partners','websiteLang'));
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
            'image'=>'required'
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text
        ];

        $this->validate($request, $rules, $customMessages);

         // save image
         $image=$request->image;
         $extention=$image->getClientOriginalExtension();
         $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
         $image_path='uploads/custom-images/'.$name;

         Image::make($image)
         ->resize(800,null,function ($constraint) {
             $constraint->aspectRatio();
         })
         ->crop(400,400)
         ->save(public_path($image_path));

        $partner=new Partner();
        $partner->image=$image_path;
        $partner->link=$request->link;
        $partner->status=$request->status;
        $partner->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function update(Request $request, Partner $partner)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        if($request->image){
            $old_image=$partner->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;

            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($image_path));

            $partner->image=$image_path;
            $partner->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));
        }
        $partner->link=$request->link;
        $partner->status=$request->status;
        $partner->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.partner.index')->with($notification);
    }


    public function destroy(Partner $partner)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $old_image=$partner->image;
        $partner->delete();

        if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function changeStatus($id){
        $partner=Partner::find($id);
        if($partner->status==1){
            $partner->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $partner->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $partner->save();
        return response()->json($message);

    }
}
