<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Listing;
use Illuminate\Http\Request;
use App\ListingCategory;
use App\Location;
use App\Aminity;
use Image;
use File;
use App\ListingVideo;
use App\ListingImage;
use App\ListingAminity;
use App\ManageText;
use App\ListingReview;
use App\Wishlist;
use Auth;

use App\NotificationText;
use App\ValidationText;
use App\ListingClaime;

class StaffListingController extends Controller
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


    public function index()
    {
        $user=Auth::guard('staff')->user();
        $author_id=$user->author_id;
        $websiteLang=$this->websiteLang;
        $listings=Listing::where('admin_id',$author_id)->orderBy('id','desc')->get();
        return view('staff.listing.my-listing',compact('listings','websiteLang'));
    }


    public function create()
    {

        $listingCategories=ListingCategory::where('status',1)->get();
        $locations=Location::where('status',1)->get();
        $aminities=Aminity::where('status',1)->get();
        $websiteLang=$this->websiteLang;
        return view('staff.listing.create',compact('listingCategories','locations','aminities','websiteLang'));
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
            'title'=>'required|unique:listings',
            'slug'=>'required|unique:listings',
            'category'=>'required',
            'location'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'logo'=>'required|file',
            'thumbnail_image'=>'required|file',
            "image"    => "required",
            "banner_image"    => "required",
            'sort_description'=>'required',
            'description'=>'required',
            'status'=>'required',
            'feature'=>'required',
            'verified'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'category.required' => $this->errorTexts->where('id',20)->first()->custom_text,
            'location.required' => $this->errorTexts->where('id',21)->first()->custom_text,
            'address.required' => $this->errorTexts->where('id',22)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' => $this->errorTexts->where('id',2)->first()->custom_text,
            'google_map_embed_code.required' => $this->errorTexts->where('id',103)->first()->custom_text,
            'logo.required' => $this->errorTexts->where('id',25)->first()->custom_text,
            'thumbnail_image.required' => $this->errorTexts->where('id',26)->first()->custom_text,
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,
            'banner_image.required' => $this->errorTexts->where('id',94)->first()->custom_text,
            'sort_description.required' => $this->errorTexts->where('id',29)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
            'feature.required' => $this->errorTexts->where('id',54)->first()->custom_text,
            'verified.required' => $this->errorTexts->where('id',53)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $listing=new Listing();

        // for logo image
        if($request->file('logo')){
            $logo=$request->logo;
            $logo_extention=$logo->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$logo_extention;
            $logo_path='uploads/custom-images/'.$logo_name;
            Image::make($logo)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($logo_path));

            $listing->logo=$logo_path;
        }

        // for thumbnail image
        if($request->file('thumbnail_image')){
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
        }


        // for banner image image
        if($request->file('banner_image')){
            $banner_image=$request->banner_image;
            $banner_ext=$banner_image->getClientOriginalExtension();
            $banner_name= 'listing-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$banner_ext;
            $banner_path='uploads/custom-images/'.$banner_name;
            Image::make($banner_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($banner_path));

            $listing->banner_image=$banner_path;
        }

        // for file
        $root_path=request()->getHost();
        if($root_path=='127.0.0.1'){
            if($request->file('file')){
                $file=$request->file;
                $file_ext=$file->getClientOriginalExtension();
                $file_name= 'listing-file-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$file_ext;
                $file_path=$file_name;
                $file->move('uploads/custom-images/',$file_path);
                $listing->file=$file_path;
            }
        }else{
            if($request->file('file')){
                $file=$request->file;
                $file_ext=$file->getClientOriginalExtension();
                $file_name= 'listing-file-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$file_ext;
                $file_path=$file_name;
                $file->move(public_path().'/uploads/custom-images/',$file_path);
                $listing->file=$file_path;
            }
        }


        $admin=Auth::guard('staff')->user();
        $listing->admin_id=$admin->author_id;
        $listing->title=$request->title;
        $listing->slug=$request->slug;
        $listing->listing_category_id=$request->category;
        $listing->location_id=$request->location;
        $listing->address=$request->address;
        $listing->email=$request->email;
        $listing->phone=$request->phone;
        $listing->website=$request->website;
        $listing->google_map_embed_code=$request->google_map_embed_code;
        $listing->facebook=$request->facebook;
        $listing->twitter=$request->twitter;
        $listing->linkedin=$request->linkedin;
        $listing->whatsapp=$request->whatsapp;
        $listing->instagram=$request->instagram;
        $listing->pinterest=$request->pinterest;
        $listing->tumblr=$request->tumblr;
        $listing->youtube=$request->youtube;
        $listing->description=$request->description;
        $listing->sort_description=$request->sort_description;
        $listing->status=$request->status;
        $listing->is_featured=$request->feature;
        $listing->verified=$request->verified;
        $listing->seo_title=$request->seo_title ? $request->seo_title : 'listing seo title';
        $listing->seo_description=$request->seo_description ? $request->seo_description : 'listing seo description';
        $listing->save();

        // slider image
        if($request->file('image')){
            $images=$request->image;
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

                $listingImage->listing_id=$listing->id;
                $listingImage->save();
            }
        }

        // for video
        if($request->video){
            foreach($request->video as $vd){
                if($vd!=null){
                    $url = $vd;
                    if(preg_match('/https:\/\/www\.youtube\.com\/watch\?v=[^&]+/', $url)) {
                        $video= new ListingVideo();
                        $video->listing_id=$listing->id;
                        $video->video_link=$vd;
                        $video->save();
                    }
                }
            }
        }
        // for aminity
        if($request->aminities){
            foreach($request->aminities as $amnty){
                $aminity= new ListingAminity();
                $aminity->listing_id=$listing->id;
                $aminity->aminity_id=$amnty;
                $aminity->save();
            }
        }

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('staff.listing.index')->with($notification);



    }



    public function edit(Listing $listing)
    {
        $listingCategories=ListingCategory::where('status',1)->get();
        $locations=Location::where('status',1)->get();
        $aminities=Aminity::where('status',1)->get();
        $websiteLang=$this->websiteLang;
        $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('staff.listing.edit',compact('listingCategories','locations','aminities','listing','websiteLang','confirmNotify'));
    }


    public function update(Request $request, Listing $listing)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'title'=>'required|unique:listings,title,'.$listing->id,
            'slug'=>'required|unique:listings,slug,'.$listing->id,
            'category'=>'required',
            'location'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'google_map_embed_code'=>'required',
            'sort_description'=>'required',
            'description'=>'required',
            'status'=>'required',
            'feature'=>'required',
            'verified'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'category.required' => $this->errorTexts->where('id',20)->first()->custom_text,
            'location.required' => $this->errorTexts->where('id',21)->first()->custom_text,
            'address.required' => $this->errorTexts->where('id',22)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' => $this->errorTexts->where('id',2)->first()->custom_text,
            'google_map_embed_code.required' => $this->errorTexts->where('id',103)->first()->custom_text,
            'sort_description.required' => $this->errorTexts->where('id',29)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
            'feature.required' => $this->errorTexts->where('id',54)->first()->custom_text,
            'verified.required' => $this->errorTexts->where('id',53)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        // for file

        $root_path=request()->getHost();
        if($root_path=='127.0.0.1'){
            if($request->file('file')){
                $old_file=$listing->file;
                $file=$request->file;
                $file_ext=$file->getClientOriginalExtension();
                $file_name= 'listing-file-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$file_ext;
                $file_path=$file_name;
                $file->move('uploads/custom-images/',$file_path);
                $listing->file=$file_path;
                $listing->save();
                if($old_file){
                    if(File::exists("uploads/custom-images/".$old_file)) unlink("uploads/custom-images/".$old_file);
                }
            }
        }else{
            if($request->file('file')){
                $old_file=$listing->file;
                $file=$request->file;
                $file_ext=$file->getClientOriginalExtension();
                $file_name= 'listing-file-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$file_ext;
                $file_path=$file_name;
                $file->move(public_path().'/uploads/custom-images/',$file_path);
                $listing->file=$file_path;
                $listing->save();
                if($old_file){
                    if(File::exists("public/uploads/custom-images/".$old_file)) unlink("public/uploads/custom-images/".$old_file);
                }
            }
        }



        $admin=Auth::guard('staff')->user();
        $listing->title=$request->title;
        $listing->slug=$request->slug;
        $listing->listing_category_id=$request->category;
        $listing->location_id=$request->location;
        $listing->address=$request->address;
        $listing->email=$request->email;
        $listing->phone=$request->phone;
        $listing->website=$request->website;
        $listing->google_map_embed_code=$request->google_map_embed_code;
        $listing->facebook=$request->facebook;
        $listing->twitter=$request->twitter;
        $listing->linkedin=$request->linkedin;
        $listing->whatsapp=$request->whatsapp;
        $listing->instagram=$request->instagram;
        $listing->pinterest=$request->pinterest;
        $listing->tumblr=$request->tumblr;
        $listing->youtube=$request->youtube;
        $listing->sort_description=$request->sort_description;
        $listing->description=$request->description;
        $listing->status=$request->status;
        $listing->is_featured=$request->feature;
        $listing->verified=$request->verified;
        $listing->seo_title=$request->seo_title ? $request->seo_title : 'listing seo title';
        $listing->seo_description=$request->seo_description ? $request->seo_description : 'listing seo description';
        $listing->save();




        // for aminity
        $old_aminities=$listing->listingAminities;
        if($request->aminities){
            foreach($request->aminities as $amnty){
                $aminity= new ListingAminity();
                $aminity->listing_id=$listing->id;
                $aminity->aminity_id=$amnty;
                $aminity->save();
            }

            if($old_aminities->count()>0){
                foreach($old_aminities as $old_aminity){
                    $old_aminity->delete();
                }
            }
        }else{
            if($old_aminities->count()>0){
                foreach($old_aminities as $old_aminity){
                    $old_aminity->delete();
                }
            }
        }

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('staff.listing.index')->with($notification);
    }


    public function destroy(Listing $listing)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $old_images=$listing->listingImages;
        $old_logo=$listing->logo;
        $old_thumbnail=$listing->thumbnail_image;
        $old_banner=$listing->banner_image;
        $listing_id=$listing->id;
        $listing->delete();

        Wishlist::where('listing_id',$listing_id)->delete();
        ListingAminity::where('listing_id',$listing_id)->delete();
        ListingVideo::where('listing_id',$listing_id)->delete();
        ListingReview::where('listing_id',$listing_id)->delete();

        if($old_images->count()>0){
            foreach($old_images as $old_image){
                if(File::exists(public_path($old_image->image)))unlink(public_path($old_image->image));
            }
        }

        if(File::exists(public_path($old_logo)))unlink(public_path($old_logo));
        if(File::exists(public_path($old_thumbnail)))unlink(public_path($old_thumbnail));
        if(File::exists(public_path($old_banner)))unlink(public_path($old_banner));


        ListingImage::where('listing_id',$listing_id)->delete();
        ListingClaime::where('listing_id',$listing_id)->delete();

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('staff.listing.index')->with($notification);
    }

    public function changeStatus($id){
        $listing=Listing::find($id);
        if($listing->status==1){
            $listing->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $listing->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $listing->save();
        return response()->json($message);

    }


    public function deleteFile($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $root_path=request()->getHost();
        if($root_path=='127.0.0.1'){
            $listing=Listing::find($id);
            $old_file= $listing->file;
            $listing->file=null;
            $listing->save();
            $old_file= "uploads/custom-images/".$old_file;
            if(File::exists($old_file)) unlink($old_file);
        }else{
            $listing=Listing::find($id);
            $old_file= $listing->file;
            $listing->file=null;
            $listing->save();
            $old_file= "public/uploads/custom-images/".$old_file;
            if(File::exists($old_file)) unlink($old_file);
        }



        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
