<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;
use App\Listing;
use File;
class AdminController extends Controller
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
        $admins=Admin::where('admin_type','!=',2)->get();
        $currentAdmin=Auth::guard('admin')->user();
        if($currentAdmin->admin_type==1){
            $websiteLang=$this->websiteLang;
            $listings=Listing::all();
            return view('admin.admin.index',compact('admins','currentAdmin','websiteLang','listings'));
        }else{
            return back();
        }

    }


    public function create()
    {
        $websiteLang=$this->websiteLang;
        return view('admin.admin.create',compact('websiteLang'));
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
            'email'=>'required',
            'password'=>'required',

        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'email.required' => $this->errorTexts->where('id',1)->first()->custom_text,
            'password.required' => $this->errorTexts->where('id',12)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        $admin=new Admin();
        $admin->name=$request->name;
        $admin->slug=Str::slug($request->name);
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->status=$request->status;
        $admin->save();
        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.admin-list.index')->with($notification);
    }

    public function destroy($id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $admin=Admin::find($id);
        $old_image=$admin->image;
        $admin->delete();
        if($old_image){
            if(File::exists(public_path($old_image))) unlink(public_path($old_image));
        }

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.admin-list.index')->with($notification);
    }

    // manage blog status
    public function changeStatus($id){
        $admin=Admin::find($id);
        if($admin->status==1){
            $admin->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $admin->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $admin->save();
        return response()->json($message);

    }
}
