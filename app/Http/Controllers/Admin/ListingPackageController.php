<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ListingPackage;
use App\ManageText;
use Illuminate\Http\Request;


use App\NotificationText;
use App\ValidationText;
use App\Setting;
use App\Order;
class ListingPackageController extends Controller
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
        $packages=ListingPackage::all();
        $websiteLang=$this->websiteLang;
        $orders=Order::all();
        $currency=Setting::first();
        return view('admin.listing-package.index',compact('packages','websiteLang','orders','currency'));
    }


    public function create()
    {
        $websiteLang=$this->websiteLang;
        return view('admin.listing-package.create',compact('websiteLang'));
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
            'package_type'=>'required',
            'package_name'=>'required',
            'price'=> $request->package_type==1 ? 'required' :'',
            'number_of_days'=>'required',
            'number_of_aminities'=>'required',
            'number_of_photo'=>'required',
            'number_of_video'=>'required',
            'number_of_listing'=>'required',
            'feature'=>'required',
            'number_of_feature_listing'=>$request->feature==1 ? 'required' :'',
            'status'=>'required',
        ];

        $customMessages = [
            'package_type.required' => $this->errorTexts->where('id',55)->first()->custom_text,
            'package_name.required' => $this->errorTexts->where('id',56)->first()->custom_text,
            'price.required' => $this->errorTexts->where('id',57)->first()->custom_text,
            'number_of_days.required' => $this->errorTexts->where('id',58)->first()->custom_text,
            'number_of_aminities.required' => $this->errorTexts->where('id',59)->first()->custom_text,
            'number_of_photo.required' => $this->errorTexts->where('id',60)->first()->custom_text,
            'number_of_video.required' => $this->errorTexts->where('id',61)->first()->custom_text,
            'number_of_listing.required' => $this->errorTexts->where('id',62)->first()->custom_text,
            'number_of_feature_listing.required' => $this->errorTexts->where('id',63)->first()->custom_text,
            'feature.required' => $this->errorTexts->where('id',54)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);



        $package=new ListingPackage();
        $package->package_type=$request->package_type;
        $package->package_name=$request->package_name;
        $package->price=$request->price ? $request->price : 0;
        $package->number_of_days=$request->number_of_days;
        $package->number_of_aminities=$request->number_of_aminities;
        $package->number_of_photo=$request->number_of_photo;
        $package->number_of_video=$request->number_of_video;
        $package->number_of_listing=$request->number_of_listing;
        $package->is_featured=$request->feature;
        $package->number_of_feature_listing=$request->number_of_feature_listing ? $request->number_of_feature_listing : 0;
        $package->status=$request->status;
        $package->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.listing-package.index')->with($notification);

    }


    public function edit(ListingPackage $listingPackage)
    {
        $websiteLang=$this->websiteLang;
        return view('admin.listing-package.edit',compact('listingPackage','websiteLang'));
    }


    public function update(Request $request, ListingPackage $listingPackage)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'package_type'=>'required',
            'package_name'=>'required',
            'price'=> $request->package_type==1 ? 'required' :'',
            'number_of_days'=>'required',
            'number_of_aminities'=>'required',
            'number_of_photo'=>'required',
            'number_of_video'=>'required',
            'number_of_listing'=>'required',
            'feature'=>'required',
            'number_of_feature_listing'=>$request->feature==1 ? 'required' :'',
            'status'=>'required',
        ];

        $customMessages = [
            'package_type.required' => $this->errorTexts->where('id',55)->first()->custom_text,
            'package_name.required' => $this->errorTexts->where('id',56)->first()->custom_text,
            'price.required' => $this->errorTexts->where('id',57)->first()->custom_text,
            'number_of_days.required' => $this->errorTexts->where('id',58)->first()->custom_text,
            'number_of_aminities.required' => $this->errorTexts->where('id',59)->first()->custom_text,
            'number_of_photo.required' => $this->errorTexts->where('id',60)->first()->custom_text,
            'number_of_video.required' => $this->errorTexts->where('id',61)->first()->custom_text,
            'number_of_listing.required' => $this->errorTexts->where('id',62)->first()->custom_text,
            'number_of_feature_listing.required' => $this->errorTexts->where('id',63)->first()->custom_text,
            'feature.required' => $this->errorTexts->where('id',54)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        $listingPackage->package_type=$request->package_type;
        $listingPackage->package_name=$request->package_name;
        $listingPackage->price=$request->package_type ==1 ? $request->price : 0;
        $listingPackage->number_of_days=$request->number_of_days;
        $listingPackage->number_of_aminities=$request->number_of_aminities;
        $listingPackage->number_of_photo=$request->number_of_photo;
        $listingPackage->number_of_video=$request->number_of_video;
        $listingPackage->number_of_listing=$request->number_of_listing;
        $listingPackage->is_featured=$request->feature;
        $listingPackage->number_of_feature_listing=$request->feature==1 ? $request->number_of_feature_listing : 0;
        $listingPackage->status=$request->status;
        $listingPackage->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.listing-package.index')->with($notification);
    }


    public function destroy(ListingPackage $listingPackage)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $listingPackage->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.listing-package.index')->with($notification);
    }

    public function changeStatus($id){
        $package=ListingPackage::find($id);
        if($package->status==1){
            $package->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $package->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $package->save();
        return response()->json($message);

    }
}
