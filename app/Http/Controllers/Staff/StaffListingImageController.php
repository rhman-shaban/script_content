<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Listing;
use App\ListingImage;
use App\ManageText;
use Image;
use File;
use Auth;

use App\NotificationText;
use App\ValidationText;
class StaffListingImageController extends Controller
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

    public function index($id){
        $listing=Listing::find($id);
        $websiteLang=$this->websiteLang;
        if($listing){
            $user=Auth::guard('staff')->user();

            if($user->author_id==$listing->admin_id){
                $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
                return view('staff.listing.image',compact('listing','websiteLang','confirmNotify'));
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('staff.listing.index')->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('staff.listing.index')->with($notification);
        }

    }


    public function newBanner(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'banner_image'=>'required',
        ];

        $customMessages = [
            'banner_image.required' => $this->errorTexts->where('id',94)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);



        if($request->file('banner_image')){
            $listing=Listing::find($request->listing_id);
            $old_banner_image=$listing->banner_image;

            $banner_image=$request->banner_image;
            $banner_ext=$banner_image->getClientOriginalExtension();
            $banner_name= 'listing-thumb-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$banner_ext;
            $banner_path='uploads/custom-images/'.$banner_name;
            Image::make($banner_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($banner_path));

            $listing->banner_image=$banner_path;
            $listing->save();

            if(File::exists(public_path($old_banner_image)))unlink(public_path($old_banner_image));


            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
    }


    public function newImage(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'images'=>'required',
        ];

        $customMessages = [
            'images.required' => $this->errorTexts->where('id',27)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        // slider image
        if($request->file('images')){
            $images=$request->images;
            foreach($images as $image){

                $listingImage=new ListingImage();
                $slider_ext=$image->getClientOriginalExtension();
                // for small image
                $slider_small_image= 'listing-sm-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$slider_ext;
                $slider_path='uploads/custom-images/'.$slider_small_image;

                Image::make($image)
                        ->resize(1000,null,function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path($slider_path));

                $listingImage->image=$slider_path;
                $listingImage->listing_id=$request->listing_id;
                $listingImage->save();
            }
        }


        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteImage($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $listingImage=ListingImage::find($id);
        $oldImage=$listingImage;
        $listingImage->delete();

        if(File::exists(public_path($oldImage->image)))unlink(public_path($oldImage->image));

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function newLogo(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'logo'=>'required',
        ];

        $customMessages = [
            'logo.required' => $this->errorTexts->where('id',25)->first()->custom_text,
        ];
        // for logo image
        if($request->file('logo')){
            $listing=Listing::find($request->listing_id);
            $old_logo=$listing->logo;

            $logo=$request->logo;
            $logo_extention=$logo->getClientOriginalExtension();
            $logo_name= 'list-logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$logo_extention;
            $logo_path='uploads/custom-images/'.$logo_name;

            Image::make($logo)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($logo_path));


            $listing->logo=$logo_path;
            $listing->save();

            if(File::exists(public_path($old_logo)))unlink(public_path($old_logo));

            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function newThumbnail(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'thumbnail_image'=>'required',
        ];

        $customMessages = [
            'thumbnail_image.required' => $this->errorTexts->where('id',26)->first()->custom_text,
        ];
        // for thumbnail image
        if($request->file('thumbnail_image')){
            $listing=Listing::find($request->listing_id);
            $old_thumbnail_image=$listing->thumbnail_image;

            $thumbnail_image=$request->thumbnail_image;
            $thumbnail_extention=$thumbnail_image->getClientOriginalExtension();
            $thumb_name= 'listing-thumb-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$thumbnail_extention;
            $thumb_path='uploads/custom-images/'.$thumb_name;
            Image::make($thumbnail_image)
                ->resize(1400,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(700,700)
                ->save(public_path($thumb_path));

            $listing->thumbnail_image=$thumb_path;
            $listing->save();

            if(File::exists(public_path($old_thumbnail_image)))unlink(public_path($old_thumbnail_image));


            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
