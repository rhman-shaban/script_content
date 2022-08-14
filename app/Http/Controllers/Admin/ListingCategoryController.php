<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ListingCategory;
use App\ManageText;
use App\Listing;
use Illuminate\Http\Request;
use Image;
use File;
use App\NotificationText;
use App\ValidationText;
class ListingCategoryController extends Controller
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
        $categories=ListingCategory::all();
        $websiteLang=$this->websiteLang;
        $listings=Listing::all();
        return view('admin.listing.category.index',compact('categories','websiteLang','listings'));
    }


    public function create()
    {
        $websiteLang=$this->websiteLang;
        return view('admin.listing.category.create',compact('websiteLang'));
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
            'name'=>'required|unique:listing_categories',
            'slug'=>'required|unique:listing_categories',
            'icon'=>'required',
            'image'=>'required',
            'status'=>'required'
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'name.unique' => $this->errorTexts->where('id',44)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        // for image
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $image_name= 'listing-category-icon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/custom-images/'.$image_name;

        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($image_path));

        $category=new ListingCategory();
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->icon=$request->icon;
        $category->image=$image_path;
        $category->status=$request->status;
        $category->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }


    public function edit(ListingCategory $listingCategory)
    {
        $websiteLang=$this->websiteLang;
        return view('admin.listing.category.edit',compact('listingCategory','websiteLang'));
    }


    public function update(Request $request, ListingCategory $listingCategory)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'name'=>'required|unique:listing_categories,name,'.$listingCategory->id,
            'slug'=>'required|unique:listing_categories,slug,'.$listingCategory->id,
            'icon'=>'required',
            'status'=>'required'

        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'name.unique' => $this->errorTexts->where('id',44)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        // for image
        if($request->image){
            $old_image=$listingCategory->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'listing-category-icon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$image_name;
            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($image_path));


            $listingCategory->image=$image_path;
            $listingCategory->save();

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }
        $listingCategory->name=$request->name;
        $listingCategory->slug=$request->slug;
        $listingCategory->icon=$request->icon;
        $listingCategory->status=$request->status;
        $listingCategory->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.listing-category.index')->with($notification);

    }


    public function destroy(ListingCategory $listingCategory)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $old_image=$listingCategory->image;
        $listingCategory->delete();

        if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.listing-category.index')->with($notification);
    }

    public function changeStatus($id){
        $category=ListingCategory::find($id);
        if($category->status==1){
            $category->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $category->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $category->save();
        return response()->json($message);

    }
}
