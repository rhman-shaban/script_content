<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Config;
use App\Setting;
use App\Admin;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;

use App\ConditionPrivacy;
use App\ContactMessage;
use App\ContactUs;

use App\Feature;
use App\Location;
use App\Order;
use App\Overview;
use App\OverviewVideo;
use App\Partner;

use App\ListingSchedule;
use App\Listing;
use App\ListingReview;
use App\ListingVideo;
use App\ListingImage;
use App\Subscribe;
use App\Testimonial;
use App\User;
use App\EmailTemplate;
use App\Aminity;
use App\ListingAminity;
use App\ListingCategory;
use App\ListingPackage;
use App\Wishlist;
use App\ModalConsent;
use App\ManageText;
use App\Navigation;

use App\NotificationText;
use App\ValidationText;
use App\CustomPage;
use App\ListingClaime;
use App\PaystackAndMollie;
use App\Instamojo;
use App\Currency;
use App\CurrencyCountry;

class SettingsController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting=Setting::first();
        if($setting){

            $websiteLang=$this->websiteLang;
            $menus=Navigation::all();
            $currencies = Currency::orderBy('name','asc')->get();
            return view('admin.settings.index',compact('setting','websiteLang','menus','currencies'));
        }
    }


    public function update(Request $request, Setting $setting)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'email'=>'required',
            'currency_name'=>'required',
            'currency_icon'=>'required',
            'currency_rate'=>'required|numeric',
            'prenotification_day'=>'required',
            'dashboard_header'=>'required',
            'dashbaord_header_icon'=>'required',
        ];

        $customMessages = [
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'currency_name.required' => $this->errorTexts->where('id',72)->first()->custom_text,
            'currency_icon.required' => $this->errorTexts->where('id',73)->first()->custom_text,
            'currency_rate.required' => $this->errorTexts->where('id',106)->first()->custom_text,
            'prenotification_day.required' => $this->errorTexts->where('id',75)->first()->custom_text,
            'dashboard_header.required' => $this->errorTexts->where('id',104)->first()->custom_text,
            'dashbaord_header_icon.required' => $this->errorTexts->where('id',105)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


         // for logo
        if($request->logo){
            $old_logo=$setting->logo;
            $image=$request->logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                ->save(public_path($logo_name));
            $setting->logo=$logo_name;
            $setting->save();

            if(File::exists(public_path($old_logo)))unlink(public_path($old_logo));

        }


     // for favicon
        if($request->favicon){
            $old_favicon=$setting->favicon;
            $favicon=$request->favicon;
            $ext=$favicon->getClientOriginalExtension();
            $favicon_name= 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $favicon_name='uploads/website-images/'.$favicon_name;

            Image::make($favicon)
                ->save(public_path($favicon_name));
                $setting->favicon=$favicon_name;
            if(File::exists(public_path($old_favicon)))unlink(public_path($old_favicon));

        }

        $setting->email=$request->email;
        $setting->save_contact_message=$request->save_contact_message;
        $setting->text_direction=$request->text_direction;
        $setting->currency_name=$request->currency_name;
        $setting->currency_icon=$request->currency_icon;
        $setting->currency_rate=$request->currency_rate;
        $setting->prenotification_day=$request->prenotification_day;
        $setting->allow_credit_card_section=$request->allow_credit_card_section;
        $setting->timezone=$request->timezone;
        $setting->dashboard_header=$request->dashboard_header;
        $setting->dashbaord_header_icon=$request->dashbaord_header_icon;
        $setting->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.settings.index')->with($notification);


    }


    public function blogCommentSetting(){
        $setting=Setting::first();
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('admin.settings.blog-comment.index',compact('setting','websiteLang','menus'));
    }

    public function updateCommentSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->comment_type==0){
            $rules = [
                'facebook_comment_script'=>'required'
            ];

            $customMessages = [
                'facebook_comment_script.required' => $this->errorTexts->where('id',76)->first()->custom_text,
            ];

            $this->validate($request, $rules, $customMessages);
        }

        $setting=Setting::first();
        $setting->comment_type=$request->comment_type;
        $setting->facebook_comment_script=$request->facebook_comment_script;
        $setting->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }


    public function cookieConsentSetting(){
        $setting=ModalConsent::first();
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('admin.settings.cookie-consent.index',compact('setting','websiteLang','menus'));
    }

    public function updateCookieConsentSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->allow==1){
            $rules = [
                'allow'=>'required',
                'border'=>'required',
                'corners'=>'required',
                'background_color'=>'required',
                'text_color'=>'required',
                'border_color'=>'required',
                'button_color'=>'required',
                'btn_text_color'=>'required',
                'link_text'=>'required',
                'btn_text'=>'required',
                'message'=>'required'
            ];

            $customMessages = [
                'allow.required' => $this->errorTexts->where('id',77)->first()->custom_text,
                'border.required' => $this->errorTexts->where('id',8)->first()->custom_text,
                'corners.required' => $this->errorTexts->where('id',79)->first()->custom_text,
                'background_color.required' => $this->errorTexts->where('id',80)->first()->custom_text,
                'text_color.required' => $this->errorTexts->where('id',81)->first()->custom_text,
                'border_color.required' => $this->errorTexts->where('id',82)->first()->custom_text,
                'button_color.required' => $this->errorTexts->where('id',83)->first()->custom_text,
                'btn_text_color.required' => $this->errorTexts->where('id',84)->first()->custom_text,
                'link_text.required' => $this->errorTexts->where('id',85)->first()->custom_text,
                'btn_text.required' => $this->errorTexts->where('id',86)->first()->custom_text,
                'message.required' => $this->errorTexts->where('id',7)->first()->custom_text,
            ];

            $this->validate($request, $rules, $customMessages);

        }

        $modalConsent=ModalConsent::first();
        $modalConsent->status=$request->allow;
        $modalConsent->border=$request->border;
        $modalConsent->corners=$request->corners;
        $modalConsent->background_color=$request->background_color;
        $modalConsent->text_color=$request->text_color;
        $modalConsent->border_color=$request->border_color;
        $modalConsent->btn_bg_color=$request->button_color;
        $modalConsent->btn_text_color=$request->btn_text_color;
        $modalConsent->link_text=$request->link_text;
        $modalConsent->btn_text=$request->btn_text;
        $modalConsent->message=$request->message;
        $modalConsent->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function captchaSetting(){
        $setting=Setting::first();
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('admin.settings.google-captcha.index',compact('setting','websiteLang','menus'));
    }

    public function updateCaptchaSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->allow_captcha==1){
            $rules = [
                'captcha_key'=>'required',
                'captcha_secret'=>'required',
            ];

            $customMessages = [
                'captcha_key.required' => $this->errorTexts->where('id',87)->first()->custom_text,
                'captcha_secret.required' => $this->errorTexts->where('id',88)->first()->custom_text,
            ];

            $this->validate($request, $rules, $customMessages);
        }

        $setting=Setting::first();
        $setting->allow_captcha=$request->allow_captcha;
        $setting->captcha_key=$request->captcha_key;
        $setting->captcha_secret=$request->captcha_secret;
        $setting->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function clearDatabase(){
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('admin.settings.clear-database.index',compact('websiteLang','menus'));
    }

    public function destroyDatabase(){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        Aminity::truncate();
        Blog::truncate();
        BlogCategory::truncate();
        BlogComment::truncate();
        ConditionPrivacy::truncate();
        ContactMessage::truncate();
        Feature::truncate();
        Listing::truncate();
        ListingAminity::truncate();
        ListingCategory::truncate();
        ListingImage::truncate();
        ListingPackage::truncate();
        ListingReview::truncate();
        ListingSchedule::truncate();
        ListingVideo::truncate();
        Location::truncate();
        Order::truncate();
        Overview::truncate();
        OverviewVideo::truncate();
        Partner::truncate();
        Subscribe::truncate();
        Testimonial::truncate();
        User::truncate();
        Wishlist::truncate();
        CustomPage::truncate();
        ListingClaime::truncate();




        $folderPath = public_path('uploads/custom-images');
        $response = File::deleteDirectory($folderPath);

        $path = public_path('uploads/custom-images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);

        }

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.dashboard')->with($notification);

    }


    public function livechatSetting(){
        $setting=Setting::first();
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('admin.settings.live-chat.index',compact('setting','websiteLang','menus'));
    }

    public function updateLivechatSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->live_chat==1){
            $rules = [
                'livechat_script'=>'required'
            ];

            $customMessages = [
                'livechat_script.required' => $this->errorTexts->where('id',89)->first()->custom_text,
            ];

            $this->validate($request, $rules, $customMessages);
        }

        $setting=Setting::first();
        $setting->live_chat=$request->live_chat;
        $setting->livechat_script=$request->livechat_script;
        $setting->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }

    public function preloaderSetting(){
        $setting=Setting::first();
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        return view('admin.settings.preloader.index',compact('setting','websiteLang','menus'));

    }

    public function preloaderUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $setting=Setting::find($id);
        if($request->preloader_image){

            $root_path=request()->getHost();
            if($root_path=='127.0.0.1'){
                $old_preloader=$setting->preloader_image;

                if(File::exists($old_preloader))unlink($old_preloader);

                $ext = $request->file('preloader_image')->extension();
                $final_name = 'preloader_image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
                $request->file('preloader_image')->move('uploads/website-images/',$final_name);
                $setting->preloader_image='uploads/website-images/'.$final_name;
                $setting->preloader=$request->preloader;
                $setting->save();
            }else{
                $old_preloader=$setting->preloader_image;

                if(File::exists(public_path($old_preloader)))unlink(public_path($old_preloader));

                $ext = $request->file('preloader_image')->extension();
                $final_name = 'preloader_image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
                $request->file('preloader_image')->move(public_path('uploads/website-images/'), $final_name);
                $setting->preloader_image='uploads/website-images/'.$final_name;
                $setting->preloader=$request->preloader;
                $setting->save();
            }



        }else{
            $setting->preloader=$request->preloader;
            $setting->save();
        }

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function googleAnalytic(){
        $setting=Setting::first();
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();
        return view('admin.settings.google-analytic.index',compact('setting','websiteLang','menus'));
    }

    public function googleAnalyticUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->google_analytic==1){

            $rules = [
                'google_analytic_code'=>'required'
            ];

            $customMessages = [
                'google_analytic_code.required' => $this->errorTexts->where('id',90)->first()->custom_text,
            ];

            $this->validate($request, $rules, $customMessages);
        };

        $setting=Setting::first();
        $setting->google_analytic=$request->google_analytic;
        $setting->google_analytic_code=$request->google_analytic_code;
        $setting->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }



    public function emailTemplate(){
        $templates=EmailTemplate::all();
        $websiteLang=$this->websiteLang;
        return view('admin.settings.email-template.index',compact('templates','websiteLang'));
    }

    public function editEmail($id){
        $email=EmailTemplate::find($id);
        $websiteLang=$this->websiteLang;
        if($id==1){
            return view('admin.settings.email-template.reset-edit',compact('email','websiteLang'));
        }else if($id==2){
            return view('admin.settings.email-template.contact-edit',compact('email','websiteLang'));
        }else if($id==3){
            return view('admin.settings.email-template.doctor-login-edit',compact('email'));
        }else if($id==4){
            return view('admin.settings.email-template.subscribe-edit',compact('email','websiteLang'));
        }else if($id==5){
            return view('admin.settings.email-template.verification-edit',compact('email','websiteLang'));
        }else if($id==6){
            return view('admin.settings.email-template.order-edit',compact('email','websiteLang'));
        }else if($id==7){
            return view('admin.settings.email-template.pre-notification',compact('email','websiteLang'));
        }
        else if($id==8){
            return view('admin.settings.email-template.payment-accept',compact('email','websiteLang'));
        }

    }

    public function updateEmail(Request $request,$id){


        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'subject'=>'required',
            'description'=>'required',
        ];

        $customMessages = [
            'subject.required' => $this->errorTexts->where('id',6)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        EmailTemplate::where('id',$id)->update([
            'subject'=>$request->subject,
            'description'=>$request->description
        ]);

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.email.template')->with($notification);
    }


    public function themeColor(){
        $setting=Setting::first();
        $websiteLang=ManageText::all();
        return view('admin.settings.theme-color.index',compact('setting','websiteLang'));
    }

    public function themeColorUpdate(Request $request){

              // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $setting=Setting::first();
        $setting->theme_one=$request->theme_one;
        $setting->theme_two=$request->theme_two;
        $setting->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }




}
