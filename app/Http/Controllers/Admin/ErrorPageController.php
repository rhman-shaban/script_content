<?php

namespace App\Http\Controllers\Admin;

use App\ErrorPage;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
class ErrorPageController extends Controller
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
        $errorpages=ErrorPage::all();
        $error_404=$errorpages->where('id',1)->first();
        $error_500=$errorpages->where('id',2)->first();
        $websiteLang=$this->websiteLang;
        return view('admin.error.index',compact('error_500','error_404','errorpages','websiteLang'));
    }




    public function update(Request $request, ErrorPage $errorPage)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'page_name'=>'required',
            'page_number'=>'required',
            'first_header'=>'required',
            'second_header'=>'required',
            'button_text'=>'required',
            'description'=>'required',
        ];

        $customMessages = [
            'page_name.required' => $this->errorTexts->where('id',92)->first()->custom_text,
            'page_number.unique' => $this->errorTexts->where('id',114)->first()->custom_text,
            'first_header.required' => $this->errorTexts->where('id',112)->first()->custom_text,
            'second_header.required' => $this->errorTexts->where('id',113)->first()->custom_text,
            'button_text.required' => $this->errorTexts->where('id',111)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
        ];

        $this->validate($request, $rules,$customMessages);


        if($request->image){
            $old_image=$errorPage->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'error-img-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/website-images/'.$name;
            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($image_path));

            $errorPage->image=$image_path;
            $errorPage->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }

        $errorPage->page_name=$request->page_name;
        $errorPage->page_number=$request->page_number;
        $errorPage->first_header=$request->first_header;
        $errorPage->second_header=$request->second_header;
        $errorPage->button_text=$request->button_text;
        $errorPage->description=$request->description;
        $errorPage->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.error-page.index')->with($notification);


    }

}
