<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;
use File;
use App\Setting;
use App\ListingReview;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
use App\Navigation;
use App\BannerImage;
use Hash;
use App\ListingPackage;
use App\ListingClaime;
use App\UserSocialLink;
use Str;
use Illuminate\Pagination\Paginator;

class UserHomeController extends Controller
{

    public $notify;
    public $errorTexts;
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

    public function ListingPackage(){
        $notify=$this->notify->where('id',32)->first()->custom_text;
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        $listingPackages=ListingPackage::where('status',1)->get();
        $currency=Setting::first();
        $confirmNotify=$this->notify->where('id',48)->first()->custom_text;
        return view('user.profile.package',compact('websiteLang','menus','notify','listingPackages','currency','confirmNotify'));
    }
    public function review(){
        $user=Auth::guard('web')->user();
        $myReviews=ListingReview::where('user_id',$user->id)->get();

        $visitorReviews=ListingReview::join('listings','listings.id','listing_reviews.listing_id')->join('users','users.id','listing_reviews.user_id')
        ->where('listings.user_id',$user->id)->select('listing_reviews.*','listings.id as list_id','listings.logo','listings.slug','listings.title','users.image as user_image','users.name')->get();
        $notify=$this->notify->where('id',32)->first()->custom_text;
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.profile.review',compact('myReviews','visitorReviews','notify','websiteLang','menus'));
    }




    public function profile(){
        $user=Auth::guard('web')->user();

        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        $defaultProfile=BannerImage::find(15)->image;
        $image=BannerImage::find(18);
        $socialLinks=$user->socialLinks;
        $socialQty=$socialLinks->count()==0 ? 0 : $socialLinks->count();
        return view('user.profile.my-profile',compact('user','websiteLang','menus','defaultProfile','image','socialLinks','socialQty'));
    }

    public function removeSocialLink($id){
        $link=UserSocialLink::find($id);
        $link->delete();
        $user=Auth::guard('web')->user();
        $socialLinks=$user->socialLinks;
        $socialQty=$socialLinks->count()==0 ? 0 : $socialLinks->count();

        $message=$this->notify->where('id',10)->first()->custom_text;
        return response()->json(['success'=>$message,'socialQty'=>$socialQty]);
    }

    public function getSocialQty(){
        $user=Auth::guard('web')->user();
        $socialLinks=$user->socialLinks;
        $socialQty=$socialLinks->count()==0 ? 0 : $socialLinks->count();
        return response()->json(['socialQty'=>$socialQty]);
    }


    public function updateProfileBanner(Request $request){

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

        $user=Auth::guard('web')->user();

        if($request->file('banner_image')){
            $old_banner_image=$user->banner_image;
            $banner_image=$request->banner_image;
            $banner_ext=$banner_image->getClientOriginalExtension();
            $banner_name= 'listing-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$banner_ext;
            $banner_path='uploads/custom-images/'.$banner_name;
            Image::make($banner_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($banner_path));

            $user->banner_image=$banner_path;
            $user->save();

            if($old_banner_image){
                if(File::exists(public_path($old_banner_image)))unlink(public_path($old_banner_image));
            }

        }

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('user.my-profile')->with($notification);
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
            'email'=>'required|email',
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        $user=Auth::guard('web')->user();

        // for profile image
        if($request->file('image')){
            $old_image=$user->image;
            $image=$request->image;
            $image_extention=$image->getClientOriginalExtension();
            $image_name= 'user-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$image_extention;
            $image_path='uploads/custom-images/'.$image_name;

            Image::make($image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($image_path));

            $user->image=$image_path;
            $user->save();
            if($old_image){
                if(File::exists(public_path($old_image)))unlink(public_path($old_image));
            }

        }

        $user->name=$request->name;
        $user->slug=Str::slug($request->name);
        $user->phone=$request->phone;
        $user->about=$request->about;
        $user->address=$request->address;
        $user->website=$request->website;
        $user->save();

        if(count($request->links) > 0){

            $socialLinks=$user->socialLinks;
            foreach($socialLinks as $link){
                $link->delete();
            }

            foreach($request->links as $index=> $link){
                if($request->links[$index] != null && $request->icons[$index] != null){
                    $socialLink=new UserSocialLink();
                    $socialLink->user_id=$user->id;
                    $socialLink->icon=$request->icons[$index];
                    $socialLink->link=$request->links[$index];
                    $socialLink->save();
                }
            }
        }



        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('user.my-profile')->with($notification);
    }

    public function updatePassword(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'current_password'=>'required',
            'password'=>'required|confirmed|min:3',
        ];

        $customMessages = [
            'current_password.required' => $this->errorTexts->where('id',13)->first()->custom_text,
            'password.required' => $this->errorTexts->where('id',12)->first()->custom_text,
            'password.confirmed' => $this->errorTexts->where('id',14)->first()->custom_text,
            'password.min' => $this->errorTexts->where('id',35)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);



        $user=Auth::guard('web')->user();
        if(Hash::check($request->current_password,$user->password)){
            $user->password=Hash::make($request->password);
            $user->save();
            $notification=array(
                'messege'=>$this->notify->where('id',13)->first()->custom_text,
                'alert-type'=>'success'
            );
            return redirect()->route('user.my-profile')->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',14)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->route('user.my-profile')->with($notification);
        }


    }


    public function storeReview(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'rating'=>'required',
            'listing_id'=>'required',
            'comment'=>'required'
        ];

        $customMessages = [
            'rating.required' => $this->errorTexts->where('id',15)->first()->custom_text,
            'listing_id.required' => $this->errorTexts->where('id',16)->first()->custom_text,
            'comment.required' => $this->errorTexts->where('id',10)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $user=Auth::guard('web')->user();

        $isExist=ListingReview::where(['user_id'=>$user->id,'listing_id'=>$request->listing_id])->count();

        if($isExist==0){
            $review=new ListingReview();
            $review->user_id=$user->id;
            $review->rating=$request->rating;
            $review->listing_id=$request->listing_id;
            $review->comment=$request->comment;
            $review->status=0;
            $review->save();

            $notification=$this->notify->where('id',1)->first()->custom_text;
            return response()->json(['success'=>$notification]);
        }{
            $notification=$this->notify->where('id',40)->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }


    }



    public function editReview($id){
        $review=ListingReview::find($id);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.profile.edit-review',compact('review','websiteLang','menus'));
    }

    public function updateReview(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'rating'=>'required',
            'comment'=>'required'
        ];

        $customMessages = [
            'rating.required' => $this->errorTexts->where('id',15)->first()->custom_text,
            'comment.required' => $this->errorTexts->where('id',10)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $review=ListingReview::find($id);
        if(!$review){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        $user=Auth::guard('web')->user();
        if($user->id==$review->user_id){
            $review->rating=$request->rating;
            $review->comment=$request->comment;
            $review->save();
            $notification=array(
                'messege'=>$this->notify->where('id',8)->first()->custom_text,
                'alert-type'=>'success'
            );
            return redirect()->route('user.review')->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }


    }

    public function deleteReview($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $review=ListingReview::find($id);
        $user=Auth::guard('web')->user();
        if(!$review){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

        if($user->id==$review->user_id){
            $review->delete();
            $notification=array(
                'messege'=>$this->notify->where('id',10)->first()->custom_text,
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
