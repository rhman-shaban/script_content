<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Listing;
use App\ListingCategory;
use App\Location;
use Illuminate\Http\Request;
use App\Aminity;
use App\ListingImage;
use App\ListingVideo;
use App\ListingAminity;
use App\ListingPackage;
use App\NotificationText;
use App\ValidationText;
use App\Order;
use App\Navigation;
use App\Day;
use App\ManageText;
use App\ListingReview;
use App\Setting;
use App\Wishlist;
use Image;
use File;
use Auth;
use App\ListingClaime;
class ListingController extends Controller
{
    public $notify;
    public $errorTexts;
    public $websiteLang;
    public function __construct()
    {
        $this->middleware('auth:web');
        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;
    }

    public function index()
    {
        $user=Auth::guard('web')->user();
        $listings=Listing::where('user_id',$user->id)->orderBy('id','desc')->get();
        if($listings->count()==0){
            $notification=array(
                'messege'=>$this->notify->where('id',39)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }
        $allListings=Listing::where('user_id',$user->id)->orderBy('id','desc')->get();


        $days=Day::all();
        $notify=$this->notify->where('id',32)->first()->custom_text;
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        $activeOrder=Order::where(['status'=>1,'user_id'=>$user->id])->first();

        if(!$activeOrder){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }

        if($activeOrder->expired_day ==-1){
            $activeQty=-1; /**that means unlimited expired date**/
        }elseif(date('Y-m-d')  < $activeOrder->expired_date){
            $activeQty=$activeOrder->listingPackage->number_of_listing;  /**that means currently active listing qty**/
        }elseif(date('Y-m-d')  > $activeOrder->expired_date){
            $activeQty=-2; /**that means all listing inactive**/
        }
        return view('user.profile.listing.my-listing',compact('listings','days','notify','websiteLang','menus','user','activeQty','allListings'));
    }


    public function create(Request $request)
    {
        $user=Auth::guard('web')->user();
        $order=Order::where(['user_id'=>$user->id,'status'=>1])->first();
        if(!$order){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }

        $isExpired=false;
        if($order->expired_date != null){
            if(date('Y-m-d') > $order->expired_date){
                $isExpired=true;
            }
        }

        if($isExpired==true){
            $notification=array(
                'messege'=>$this->notify->where('id',38)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }

        $expired_date= $order->expired_date==null ? -1 : $order->expired_date;
        $listingCategories=ListingCategory::where('status',1)->get();
        $locations=Location::where('status',1)->get();
        $aminities=Aminity::where('status',1)->orderBy('aminity','asc')->get();
        $package=ListingPackage::find($order->listing_package_id);

        if($package){
            if($package->number_of_listing==-1){
                $existingFeaturedListing=Listing::where(['user_id'=>$user->id,'is_featured'=>1])->count();
                $websiteLang=$this->websiteLang;
                $menus=Navigation::all();

                return view('user.profile.listing.create',compact('listingCategories','locations','aminities','package','existingFeaturedListing','websiteLang','menus','expired_date'));

            }else if($package->number_of_listing > 0){
                $existListings=Listing::where('user_id',$user->id)->count();
                if($existListings < $package->number_of_listing){
                    $existingFeaturedListing=Listing::where(['user_id'=>$user->id,'is_featured'=>1])->count();
                    $websiteLang=$this->websiteLang;
                    $menus=Navigation::all();
                    return view('user.profile.listing.create',compact('listingCategories','locations','aminities','package','existingFeaturedListing','websiteLang','menus','expired_date'));
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',17)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('user.dashboard')->with($notification);
                }

            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('user.dashboard')->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }


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
            'package_id'=>'required',
            'category'=>'required',
            'location'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'google_map_embed_code'=>'required',
            'logo'=>'required|file',
            'thumbnail_image'=>'required|file',
            "image"    => "required",
            "banner_image"    => "required",
            'sort_description'=>'required',
            'description'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'package_id.required' => $this->errorTexts->where('id',19)->first()->custom_text,
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





        $user=Auth::guard('web')->user();
        $listing->user_type=0;
        $listing->user_id=$user->id;
        $listing->listing_package_id=$request->package_id;
        $listing->expired_date=$request->expired_date==-1 ? null : $request->expired_date;
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
        $listing->youtube=$request->youtube;
        $listing->description=$request->description;
        $listing->sort_description=$request->sort_description;
        $listing->is_featured=$request->feature ? $request->feature : 0;
        $listing->seo_title=$request->seo_title ? $request->seo_title : 'listing seo title';
        $listing->seo_description=$request->seo_description ? $request->seo_description : 'listing seo description';
        $listing->save();

        // slider image
        if($request->file('image')){
            $images=$request->image;
            foreach($images as $image){
                if($image != null){
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
        $package=ListingPackage::find($request->package_id);
        if($request->aminities){
            if($package->number_of_aminities==-1){
                foreach($request->aminities as $index => $amnty){
                    $aminity= new ListingAminity();
                    $aminity->listing_id=$listing->id;
                    $aminity->aminity_id=$amnty;
                    $aminity->save();
                }
            }else{
                foreach($request->aminities as $index => $amnty){
                    if( ++$index > $package->number_of_aminities){
                        break;
                    }else{
                        $aminity= new ListingAminity();
                        $aminity->listing_id=$listing->id;
                        $aminity->aminity_id=$amnty;
                        $aminity->save();
                    }

                }
            }

        }

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('user.my.listing')->with($notification);



    }


    public function edit($id)
    {
        $listing=Listing::find($id);
        if($listing){
            $user=Auth::guard('web')->user();
            if($listing->user_type==0){
                if($listing->user_id==$user->id){
                    $listingCategories=ListingCategory::where('status',1)->get();
                    $locations=Location::where('status',1)->get();
                    $aminities=Aminity::where('status',1)->orderBy('aminity','asc')->get();

                    $order=Order::where(['user_id'=>$user->id,'status'=>1])->first();
                    $package=ListingPackage::find($order->listing_package_id);
                    $existingFeaturedListing=Listing::where(['user_id'=>$user->id,'is_featured'=>1])->count();
                    $websiteLang=$this->websiteLang;
                    $menus=Navigation::all();
                    $notify=$this->notify->where('id',32)->first()->custom_text;
                    return view('user.profile.listing.edit',compact('listing','listingCategories','locations','aminities','package','existingFeaturedListing','websiteLang','menus','notify'));
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',7)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('user.my.listing')->with($notification);
                }
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('user.my.listing')->with($notification);
            }

        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.my.listing')->with($notification);
        }
    }


    public function update(Request $request,$id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'title'=>'required|unique:listings,title,'.$id,
            'slug'=>'required|unique:listings,slug,'.$id,
            'category'=>'required',
            'location'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'google_map_embed_code'=>'required',
            'sort_description'=>'required',
            'description'=>'required',
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
        ];

        $this->validate($request, $rules, $customMessages);

        $user=Auth::guard('web')->user();
        $listing=Listing::find($id);


        // for logo image
        if($request->file('logo')){
            $old_logo=$listing->logo;
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
            $listing->save();

            if(File::exists(public_path($old_logo)))unlink(public_path($old_logo));

        }

        // for thumbnail image
        if($request->file('thumbnail_image')){
            $old_thumbnail=$listing->thumbnail_image;
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

            if(File::exists(public_path($old_thumbnail)))unlink(public_path($old_thumbnail));

        }


        if($request->file('banner_image')){
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

        }


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


        // slider image
        if($request->file('image')){
            $images=$request->image;
            foreach($images as $image){
                if($image != null){
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

        $listing->user_id=$user->id;
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
        $listing->youtube=$request->youtube;
        $listing->sort_description=$request->sort_description;
        $listing->description=$request->description;
        $listing->is_featured=$request->feature ? $request->feature : $listing->is_featured;
        $listing->seo_title=$request->seo_title ? $request->seo_title : 'listing seo title';
        $listing->seo_description=$request->seo_description ? $request->seo_description : 'listing seo description';
        $listing->save();

        // for aminity
        $package=ListingPackage::find($request->package_id);
        $old_aminities=$listing->listingAminities;
        if($request->aminities){

            if($package->number_of_aminities==-1){
                foreach($request->aminities as $index => $amnty){
                    $aminity= new ListingAminity();
                    $aminity->listing_id=$listing->id;
                    $aminity->aminity_id=$amnty;
                    $aminity->save();
                }
            }else{
                foreach($request->aminities as $index => $amnty){
                    if( ++$index > $package->number_of_aminities){
                        break;
                    }else{
                        $aminity= new ListingAminity();
                        $aminity->listing_id=$listing->id;
                        $aminity->aminity_id=$amnty;
                        $aminity->save();
                    }
                }
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

        return redirect()->route('user.my.listing')->with($notification);
    }


    public function destroy($id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $listing=Listing::find($id);
        if(!$listing){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.my.listing')->with($notification);
        }

        $user=Auth::guard('web')->user();
        if($user->id!=$listing->user_id){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.my.listing')->with($notification);

        }
        $old_images=$listing->listingImages;
        $old_logo=$listing->logo;
        $old_thumbnail=$listing->thumbnail_image;
        $old_banner=$listing->banner_image;
        $listing_id=$listing->id;

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

        $listing->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
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

        $image=ListingImage::find($id);
        $large_image=$image->image;
        $image->delete();

        if(File::exists(public_path($large_image)))unlink(public_path($large_image));

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteVideo($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $video=ListingVideo::find($id);
        $video->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
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
