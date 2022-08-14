<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\ListingCategory;
use App\HomeSection;
use App\Feature;
use App\Overview;
use App\OverviewVideo;
use App\Blog;
use App\Testimonial;
use App\About;
use App\AboutSection;
use App\Partner;
use App\BlogCategory;
use App\ContactUs;
use App\Setting;
use App\BlogComment;
use App\Rules\Captcha;
use App\ContactInformation;
use App\Location;
use App\ListingPackage;
use App\PackageSection;
use App\ListingAminity;
use App\Listing;
use App\Day;
use App\Aminity;
use App\Wishlist;
use App\ListingReview;
use App\Subscribe;
use App\ConditionPrivacy;
use App\EmailTemplate;
use App\SeoText;
use App\BannerImage;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
use App\Navigation;
use App\CustomPage;
use Storage;
use Str;
use Mail;
use Session;
use App\Mail\SubscribeUsNotification;
use Auth;
use App\Order;
use App\CustomPaginator;
use App\Admin;
use App\User;
use App\Helpers\MailHelper;
use App\ListingClaime;
use Illuminate\Pagination\Paginator;
class HomeController extends Controller
{

    public $notify;
    public $errorTexts;
    public $websiteLang;
    public $paginator;
    public function __construct()
    {
        $notify=NotificationText::all();
        $this->notify=$notify;
        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $paginator=CustomPaginator::all();
        $this->paginator=$paginator;

    }

    public function index(){
        $banner=Slider::first();
        $listingCategories=ListingCategory::where('status',1)->get();
        $section=HomeSection::all();
        $features=Feature::where('status',1)->get();
        $overviewVideo=OverviewVideo::first();
        if($overviewVideo){
            $overviewVideo=$overviewVideo->video_link;
        }else{
            $overviewVideo="#";
        }

        $overviews=Overview::where('status',1)->get();
        $blogs=Blog::where(['status'=>1,'show_homepage'=>1])->get();
        $testimonials=Testimonial::where('status',1)->get();
        $locations=Location::where('status',1)->get()->take(6);
        $listingPackages=ListingPackage::where('status',1)->get();
        $listings=Listing::where(['status'=>1,'is_featured'=>1])->get();
        $days=Day::all();
        $locationsForSearch=Location::where('status',1)->get();
        $seo_text=SeoText::find(1);
        $websiteLang=$this->websiteLang;
        $bannerImages=BannerImage::all();
        $currency=Setting::first();
        $notify=$this->notify->where('id',48)->first()->custom_text;



        return view('user.index',compact('banner','listingCategories','section','features','overviewVideo','overviews','blogs','testimonials','locations','listingPackages','listings','days','locationsForSearch','seo_text','websiteLang','bannerImages','currency','notify'));
    }


    public function listings(Request $request){
        Paginator::useBootstrap();
        // cheack page type, page type means grid view or listing view
        $page_type='';
        if(!$request->page_type){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->route('home')->with($notification);
        }else{
            if($request->page_type=='list_view'){
                $page_type=$request->page_type;
            }else if($request->page_type=='grid_view'){
                $page_type=$request->page_type;
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );
                return redirect()->route('home')->with($notification);
            }
        }
        // end page type

        $paginate_qty=$this->paginator->where('id',2)->first()->qty;

        // check category slug
        if($request->category_slug){
            $category=ListingCategory::where('slug',$request->category_slug)->first();
            if($category){
                // start sorting listing under category
                if($request->sorting_id){
                    $id=$request->sorting_id;
                    if($id==1){
                        $listings=Listing::where(['status'=>1,'listing_category_id'=>$category->id])
                                        ->orderBy('views','desc')
                                        ->paginate($paginate_qty);
                    }else if($id==2){
                        $listings=Listing::where(['status'=>1,'listing_category_id'=>$category->id,'is_featured'=>1])
                                        ->paginate($paginate_qty);
                    }else if($id==3){
                        $listings=Listing::where(['status'=>1,'listing_category_id'=>$category->id,'verified'=>1])
                        ->paginate($paginate_qty);
                    }else if($id==4){
                        $listings=Listing::where(['status'=>1,'listing_category_id'=>$category->id])
                                        ->paginate($paginate_qty);
                    }else if($id==5){
                        $listings=Listing::where(['status'=>1,'listing_category_id'=>$category->id])
                                        ->orderBy('id','desc')->paginate($paginate_qty);
                    }else if($id==6){
                        $listings=Listing::where(['status'=>1,'listing_category_id'=>$category->id])
                                        ->orderBy('id','desc')
                                        ->paginate($paginate_qty);
                    }
                }else{
                    $listings=Listing::where(['status'=>1,'listing_category_id'=>$category->id])
                                    ->paginate($paginate_qty);
                }
                // end sorting listing
            }else{
                return redirect()->route('home');
            }
        }else if($request->location_slug){
            $location=Location::where('slug',$request->location_slug)->first();
            if($location){
                // start sorting listing under the location
                if($request->sorting_id){
                    $id=$request->sorting_id;
                    if($id==1){
                        $listings=Listing::where(['status'=>1,'location_id'=>$location->id])->orderBy('views','desc')->paginate($paginate_qty);
                    }else if($id==2){
                        $listings=Listing::where(['status'=>1,'location_id'=>$location->id,'is_featured'=>1])->paginate($paginate_qty);
                    }else if($id==3){
                        $listings=Listing::where(['status'=>1,'location_id'=>$location->id,'verified'=>1])->paginate($paginate_qty);
                    }else if($id==4){
                        $listings=Listing::where(['status'=>1,'location_id'=>$location->id])->paginate($paginate_qty);
                    }else if($id==5){
                        $listings=Listing::where(['status'=>1,'location_id'=>$location->id])->orderBy('id','desc')->paginate($paginate_qty);
                    }else if($id==6){
                        $listings=Listing::where(['status'=>1,'location_id'=>$location->id])->orderBy('id','desc')->paginate($paginate_qty);
                    }
                // end sorting listing
                }else{
                    $listings=Listing::where(['status'=>1,'location_id'=>$location->id])
                                    ->paginate($paginate_qty);
                }


            }else{
                return redirect()->route('home');
            }
        }else{
            if($request->sorting_id){
                $id=$request->sorting_id;
                // start sorting listing
                if($id==1){
                    $listings=Listing::where(['status'=>1])->orderBy('views','desc')->paginate($paginate_qty);
                }else if($id==2){
                    $listings=Listing::where(['status'=>1,'is_featured'=>1])->paginate($paginate_qty);
                }else if($id==3){
                    $listings=Listing::where(['status'=>1,'verified'=>1])->paginate($paginate_qty);
                }else if($id==4){
                    $listings=Listing::where(['status'=>1])->paginate($paginate_qty);
                }else if($id==5){
                    $listings=Listing::where(['status'=>1])->orderBy('id','desc')->paginate($paginate_qty);
                }else if($id==6){
                    $listings=Listing::where(['status'=>1])->orderBy('id','desc')->paginate($paginate_qty);
                }
                // end sorting

            }else{
                $today=date('Y-m-d');
                $listings=Listing::where('status',1)
                ->orderBy('id','desc')->paginate($paginate_qty);
            }

        }

        $listings=$listings->appends($request->all());

        $days=Day::all();
        $listingCategories=ListingCategory::where('status',1)->get();
        $locationsForSearch=Location::where('status',1)->get();
        $aminities=Aminity::orderBy('aminity','asc')->where('status',1)->get();
        $seo_text=SeoText::find(2);
        $image=BannerImage::find(1);
        $default_image=BannerImage::find(15);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.listing.index',compact('listings','days','listingCategories','aminities','locationsForSearch','seo_text','image','websiteLang','menus','default_image','page_type'));
    }


    public function listingShow($slug){
        $listing=Listing::where('slug',$slug)->first();
        if($listing){
            $listing->views += 1;
            $listing->save();
            $days=Day::all();

            $similarListings=Listing::where('listing_category_id',$listing->listing_category_id)->where('id','!=',$listing->id)->get();
            $recentListings=Listing::where('id','!=',$listing->id)->orderBy('id','desc')->get()->take(3);

            $contactSetting=Setting::first();
            $wishlists=Wishlist::all();

            $websiteLang=$this->websiteLang;
            $menus=Navigation::all();

            $default_image=BannerImage::find(15);

            $reviews=ListingReview::where(['listing_id'=>$listing->id, 'status'=>1])->get();
            return view('user.listing.show',compact('listing','days','similarListings','recentListings','contactSetting','wishlists','reviews','websiteLang','menus','default_image'));
        }else return back();

    }

    public function aboutUs(){
        $about=About::first();
        $section=AboutSection::all();
        $features=Feature::where('status',1)->get();
        $overviewVideo=OverviewVideo::first();
        if($overviewVideo){
            $overviewVideo=$overviewVideo->video_link;
        }else{
            $overviewVideo="#";
        }
        $overviews=Overview::where('status',1)->get();
        $partners=Partner::where('status',1)->get();
        $seo_text=SeoText::find(3);
        $image=BannerImage::find(2);
        $bg_image=BannerImage::find(16);
        $overview_bg_image=BannerImage::find(13);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        return view('user.about-us',compact('about','section','features','overviewVideo','overviews','partners','seo_text','image','bg_image','overview_bg_image','websiteLang','menus'));
    }

    public function blog(){
        Paginator::useBootstrap();
        $paginate_qty=$this->paginator->where('id',1)->first()->qty;
        $blogs=Blog::where('status',1)->orderBy('id','desc')->paginate($paginate_qty);
        $seo_text=SeoText::find(6);
        $image=BannerImage::find(5);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        $setting=Setting::first();
        return view('user.blog.index',compact('blogs','seo_text','image','websiteLang','menus','setting'));
    }

    public function blogDetails($slug){

        $blog=Blog::where(['slug'=>$slug,'status'=>1])->first();
        if($blog){
            $blog->view +=1;
            $blog->save();

            $blogCategories=BlogCategory::where('status',1)->get();
            $contact_us=ContactUs::first();
            $popularBlogs=Blog::where('id','!=',$blog->id)->orderBy('view','desc')->get()->take(5);
            $commentSetting=Setting::first();
            $image=BannerImage::find(5);
            $websiteLang=$this->websiteLang;
            $menus=Navigation::all();
            $default_image=BannerImage::find(15);

            $comments=$blog->comments;
            return view('user.blog.show',compact('blog','blogCategories','contact_us','popularBlogs','commentSetting','image','websiteLang','menus','default_image','comments'));
        }else{
            return back();
        }

    }

    public function blogCategory($slug,Request $request){
        Paginator::useBootstrap();
        $category=BlogCategory::where(['slug'=>$slug,'status'=>1])->first();
        if(!$category){
            return back();
        }
        $paginate_qty=$this->paginator->where('id',1)->first()->qty;
        $blogs=Blog::where(['blog_category_id'=>$category->id,'status'=>1])->paginate($paginate_qty);
        $blogs=$blogs->appends($request->all());
        $seo_text=SeoText::find(6);
        $image=BannerImage::find(5);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.blog.index',compact('blogs','seo_text','image','websiteLang','menus'));
    }

    public function blogSearch(Request $request){
        Paginator::useBootstrap();
        $rules = [
            'search'=>'required',
        ];

        $customMessages = [
            'search.required' => $this->errorTexts->where('id',9)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);
        $paginate_qty=$this->paginator->where('id',1)->first()->qty;
        $blogs=Blog::where('title','LIKE','%'.$request->search.'%')->paginate($paginate_qty);
        $blogs=$blogs->appends($request->all());
        $seo_text=SeoText::find(6);
        $image=BannerImage::find(5);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.blog.index',compact('blogs','seo_text','image','websiteLang','menus'));
    }

    public function blogComment(Request $request,$blogId){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' => $this->errorTexts->where('id',2)->first()->custom_text,
            'comment.required' => $this->errorTexts->where('id',10)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $comment=new BlogComment();
        $comment->blog_id=$blogId;
        $comment->name=$request->name;
        $comment->email=$request->email;
        $comment->phone=$request->phone;
        $comment->comment=$request->comment;
        $comment->save();

        $notification=$this->notify->where('id',1)->first()->custom_text;
        return response()->json(['success'=>$notification]);
    }

    public function contactUs(){
        $contact=ContactInformation::first();
        $contactSetting=Setting::first();
        $seo_text=SeoText::find(7);
        $image=BannerImage::find(6);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.contact-us',compact('contact','contactSetting','seo_text','image','websiteLang','menus'));
    }

    public function pricingPlan(){
        $listingPackages=ListingPackage::where('status',1)->get();
        $sections=PackageSection::all();
        $seo_text=SeoText::find(4);
        $image=BannerImage::find(3);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        $currency=Setting::first();
        $bannerImages=BannerImage::all();
        $notify=$this->notify->where('id',48)->first()->custom_text;



        return view('user.price-plan',compact('listingPackages','sections','seo_text','image','websiteLang','menus','currency','notify','bannerImages'));
    }

    public function downloadListingFile($file){
        $filepath= public_path() . "/uploads/custom-images/".$file;
        return response()->download($filepath);
    }



    // manage subsciber
    public function subscribeUs(Request $request){
        $rules = [
            'email'=>'required|email'
        ];
        $customMessages = [
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'email.email' => $this->errorTexts->where('id',2)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $isSubsriber=Subscribe::where('email',$request->email)->count();
        if($isSubsriber ==0){
            $subscribe=Subscribe::create([
                'email'=>$request->email,
                'verify_token'=>Str::random(25)
            ]);

            MailHelper::setMailConfig();

            $template=EmailTemplate::where('id',4)->first();
            $message=$template->description;
            $subject=$template->subject;
            Mail::to($subscribe->email)->send(new SubscribeUsNotification($subscribe,$message,$subject));
            $notification=$this->notify->where('id',2)->first()->custom_text;
            return response()->json(['success'=>$notification]);
        }else{
            $notification=$this->notify->where('id',3)->first()->custom_text;

            return response()->json(['error'=>$notification]);
        }

    }

    public function subscriptionVerify($token){
        $subscribe=Subscribe::where('verify_token',$token)->first();
        if($subscribe){
            $subscribe->status=1;
            $subscribe->verify_token=null;
            $subscribe->save();
            $notification=array(
                'messege'=>$this->notify->where('id',4)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',5)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->to('/')->with($notification);
        }
    }


    public function listingCategory(){
        Paginator::useBootstrap();
        $paginate_qty=$this->paginator->where('id',3)->first()->qty;
        $listingCategories=ListingCategory::where('status',1)->paginate($paginate_qty);
        $seo_text=SeoText::find(5);
        $image=BannerImage::find(4);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.listing-category',compact('listingCategories','seo_text','image','websiteLang','menus'));
    }


    public function termsCondition(){
        $termsCondtion=ConditionPrivacy::first();
        $image=BannerImage::find(9);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.terms-condition',compact('termsCondtion','image','websiteLang','menus'));
    }

    public function privacyPolicy(){
        $privacy=ConditionPrivacy::first();
        $image=BannerImage::find(10);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.privacy-policy',compact('privacy','image','websiteLang','menus'));
    }

    public function searchListingPage(Request $request){
        Paginator::useBootstrap();
        // check page type, page type means grid view or list view
        $page_type='';
        if(!$request->page_type){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );
            return redirect()->route('home')->with($notification);
        }else{
            if($request->page_type=='list_view'){
                $page_type=$request->page_type;
            }else if($request->page_type=='grid_view'){
                $page_type=$request->page_type;
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );
                return redirect()->route('home')->with($notification);
            }
        }
        // end page type

        // check aminity
        $sortArry=[];
        if($request->aminity){
            foreach($request->aminity as $amnty){
                array_push($sortArry,(int)$amnty);
            }
        }else{
            $aminities=Aminity::where('status',1)->get();
            foreach($aminities as $aminity){
                array_push($sortArry,(int)$aminity->id);
            }
        }
        // end aminity


        // soriting data
        $paginate_qty=$this->paginator->where('id',2)->first()->qty;
        // check order type
        $orderBy="desc";
        if($request->sorting_id){
            if($request->sorting_id==4){
                $orderBy="asc";
            }else if($request->sorting_id==5){
                $orderBy="desc";
            }else if($request->sorting_id==6){
                $orderBy="desc";
            }
        }
        // end check order type
        // start query
        $listingAminities=ListingAminity::whereHas('listing',function($query) use ($request){
            if($request->category_id != null){
                $query->where(['listing_category_id'=>$request->category_id,'status'=>1]);
            }
            if($request->location != null){
                $query->where(['location_id'=>$request->location,'status'=>1]);
            }
            if($request->search != null){
                $query->where('title','LIKE','%'.$request->search.'%')->where('status',1);
            }

            if($request->sorting_id){
                if($request->sorting_id==1){
                    $query->orderBy('views','desc');
                }else if($request->sorting_id==2){
                    $query->where(['is_featured'=>1,'status'=>1]);
                }else if($request->sorting_id==3){
                    $query->where(['verified'=>1,'status'=>1]);;
                }
            }
        })->whereIn('aminity_id',$sortArry)->select('listing_id')->groupBy('listing_id')->orderBy('listing_id',$orderBy)->paginate($paginate_qty);
        // end query, sorting

        $listingAminities=$listingAminities->appends($request->all());
        $days=Day::all();
        $listingCategories=ListingCategory::where('status',1)->get();
        $locationsForSearch=Location::where('status',1)->get();
        $aminities=Aminity::where('status',1)->orderBy('aminity','asc')->get();
        $seo_text=SeoText::find(2);
        $image=BannerImage::find(1);

        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();


        return view('user.listing.search-result',compact('listingAminities','days','listingCategories','aminities','locationsForSearch','seo_text','image','websiteLang','menus','page_type'));
    }

    public function customPage($slug){
        $page=CustomPage::where('slug',$slug)->first();
        if(!$page){
            return back();
        }
        $image=BannerImage::find(17);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('user.custom-page',compact('page','image','websiteLang','menus'));
    }


    public function userProfile(Request $request){
        Paginator::useBootstrap();
        $user="";
        $listings="";
        $paginate_qty=$this->paginator->where('id',2)->first()->qty;
        if($request->user_type==1){
            if($request->slug){
                $admin=Admin::where('slug',$request->slug)->first();
                if($admin){
                    $user=$admin;
                    $listings=Listing::where(['admin_id'=>$user->id,'status'=>1])->paginate($paginate_qty);
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',7)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('home')->with($notification);
                }

            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('home')->with($notification);
            }
        }elseif($request->user_type==0){
            if($request->slug){
                $userInfo=User::where('slug',$request->slug)->first();
                if($userInfo){
                    $user=$userInfo;
                    $listings=Listing::where(['user_id'=>$user->id,'status'=>1])->paginate($paginate_qty);
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',7)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('home')->with($notification);
                }
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('home')->with($notification);
            }
        }else{

            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('home')->with($notification);
        }


        if(!$listings){
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('home')->with($notification);
        }
        $listings=$listings->appends($request->all());
        $days=Day::all();
        $listingCategories=ListingCategory::where('status',1)->get();
        $locationsForSearch=Location::where('status',1)->get();
        $aminities=Aminity::orderBy('aminity','asc')->where('status',1)->get();
        $seo_text=SeoText::find(2);
        $image=BannerImage::find(18);
        $default_image=BannerImage::find(15);
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        $user_type=$request->user_type;
        return view('user.user-profile',compact('listings','days','listingCategories','aminities','locationsForSearch','seo_text','image','websiteLang','menus','default_image','user','user_type'));

    }



    public function sendClaime(Request $request){

        $rules = [
            'comment'=>'required',
            'name'=>'required',
            'email'=>'required',
        ];
        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'comment.required' => $this->errorTexts->where('id',102)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);



        $claime=new ListingClaime();

        $claime->listing_id=$request->listing_id;
        $claime->name=$request->name;
        $claime->email=$request->email;
        $claime->comment=$request->comment;
        $claime->save();

        $notification=$this->notify->where('id',41)->first()->custom_text;
        return response()->json(['success'=>$notification]);
    }
}
