<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;

use App\NotificationText;
use App\ValidationText;

class TestimonialController extends Controller
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
        $websiteLang=$this->websiteLang;
        $testimonials=Testimonial::all();
        return view('admin.testimonial.index',compact('testimonials','websiteLang'));
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
            'name'=>'required',
            'designation'=>'required',
            'image'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'designation.required' => $this->errorTexts->where('id',91)->first()->custom_text,
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
            'rating.required' => $this->errorTexts->where('id',15)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $image_name= 'testimonial-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

        // for small image
        $image_name='uploads/custom-images/'.$image_name;
        Image::make($image)
            ->resize(600,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->crop(400,400)
            ->save(public_path($image_name));


        $testimonial=new Testimonial();
        $testimonial->name=$request->name;
        $testimonial->designation=$request->designation;
        $testimonial->image=$image_name;
        $testimonial->description=$request->description;
        $testimonial->status=$request->status;
        $testimonial->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function update(Request $request, Testimonial $testimonial)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'name'=>'required',
            'designation'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'designation.required' => $this->errorTexts->where('id',91)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        if($request->file('image')){
            $old_image=$testimonial->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'testimonial-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;


            Image::make($image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($image_name));

            $testimonial->image=$image_name;
            $testimonial->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }

        $testimonial->name=$request->name;
        $testimonial->designation=$request->designation;
        $testimonial->description=$request->description;
        $testimonial->status=$request->status;
        $testimonial->save();


        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }


    public function destroy(Testimonial $testimonial)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $image=$testimonial->image;
        $testimonial->delete();

        if(File::exists(public_path($image)))unlink(public_path($image));

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function changeStatus($id){
        $testimonial=Testimonial::find($id);
        if($testimonial->status==1){
            $testimonial->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $testimonial->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $testimonial->save();
        return response()->json($message);

    }
}
