<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
class FeatureController extends Controller
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
        $features=Feature::all();
        $websiteLang=$this->websiteLang;
        return view('admin.feature.index',compact('features','websiteLang'));
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
            'title'=>'required|unique:features',
            'icon'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);



        $feature=new Feature();
        $feature->title=$request->title;
        $feature->description=$request->description;
        $feature->icon=$request->icon;
        $feature->status=$request->status;
        $feature->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.feature.index')->with($notification);

    }


    public function update(Request $request, Feature $feature)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'title'=>'required|unique:features,title,'.$feature->id,
            'icon'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);



        // update database
        $feature->title=$request->title;
        $feature->description=$request->description;
        $feature->icon=$request->icon;
        $feature->status=$request->status;
        $feature->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.feature.index')->with($notification);
    }


    public function destroy(Feature $feature)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $feature->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.feature.index')->with($notification);

    }


    public function changeStatus($id){
        $feature=Feature::find($id);
        if($feature->status==1){
            $feature->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $feature->status=1;
            $message=$this->notify->where('id',13)->first()->custom_text;
        }
        $feature->save();
        return response()->json($message);

    }
}
