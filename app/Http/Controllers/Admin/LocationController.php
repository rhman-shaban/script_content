<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Location;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;
use App\NotificationText;
use App\ValidationText;
use App\Listing;
use Str;
class LocationController extends Controller
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
        $locations=Location::all();
        $websiteLang=$this->websiteLang;
        $listings=Listing::all();
        return view('admin.location.index',compact('locations','websiteLang','listings'));
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
            'location'=>'required|unique:locations',
            'icon'=>'required',
            'image'=>'required',
            'status'=>'required'
        ];

        $customMessages = [
            'location.required' => $this->errorTexts->where('id',21)->first()->custom_text,
            'location.unique' => $this->errorTexts->where('id',64)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        // for image
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $image_name= 'location-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/custom-images/'.$image_name;

        Image::make($image)
            ->resize(1400,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->crop(700,700)
            ->save(public_path($image_path));


        $location=new Location();
        $location->location=$request->location;
        $location->slug=Str::slug($request->location);
        $location->icon=$request->icon;
        $location->status=$request->status;
        $location->image=$image_path;
        $location->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.location.index')->with($notification);
    }


    public function update(Request $request, Location $location)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'location'=>'required|unique:locations,location,'.$location->id,
            'icon'=>'required',
            'status'=>'required'
        ];

        $customMessages = [
            'location.required' => $this->errorTexts->where('id',21)->first()->custom_text,
            'location.unique' => $this->errorTexts->where('id',64)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        // for image
        if($request->image){
            $old_image=$location->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'location-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$image_name;

            Image::make($image)
                ->resize(1500,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(700,700)
                ->save(public_path($image_path));


            $location->image=$image_path;
            $location->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }


        $location->location=$request->location;
        $location->slug=Str::slug($request->location);
        $location->icon=$request->icon;
        $location->status=$request->status;
        $location->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.location.index')->with($notification);
    }


    public function destroy(Location $location)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $old_image=$location->image;
        $location->delete();
        if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.location.index')->with($notification);
    }



    public function changeStatus($id){
        $location=Location::find($id);
        if($location->status==1){
            $location->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $location->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $location->save();
        return response()->json($message);

    }
}
