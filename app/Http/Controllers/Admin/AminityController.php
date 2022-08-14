<?php

namespace App\Http\Controllers\Admin;

use App\Aminity;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\ListingAminity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class AminityController extends Controller
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
        $aminities=Aminity::all();
        $websiteLang=$this->websiteLang;
        $listingAminities=ListingAminity::all();
        return view('admin.aminity.index',compact('aminities','websiteLang','listingAminities'));
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
            'aminity'=>'required',
            'icon'=>'required',
            'status'=>'required'

        ];

        $customMessages = [
            'aminity.required' => $this->errorTexts->where('id',43)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $aminity=new Aminity();
        $aminity->aminity=$request->aminity;
        $aminity->slug=Str::slug($request->aminity);
        $aminity->icon=$request->icon;
        $aminity->status=$request->status;
        $aminity->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.aminity.index')->with($notification);
    }




    public function update(Request $request, Aminity $aminity)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $rules = [
            'aminity'=>'required',
            'icon'=>'required',
            'status'=>'required'

        ];

        $customMessages = [
            'aminity.required' => $this->errorTexts->where('id',43)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $aminity->aminity=$request->aminity;
        $aminity->slug=Str::slug($request->aminity);
        $aminity->icon=$request->icon;
        $aminity->status=$request->status;
        $aminity->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.aminity.index')->with($notification);
    }


    public function destroy(Aminity $aminity)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $aminity->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.aminity.index')->with($notification);
    }

    public function changeStatus($id){
        $aminity=Aminity::find($id);
        if($aminity->status==1){
            $aminity->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $aminity->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $aminity->save();
        return response()->json($message);

    }
}
