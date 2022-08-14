<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Overview;
use App\OverviewVideo;
use App\ManageText;
use Illuminate\Http\Request;

use App\NotificationText;
use App\ValidationText;
class OverviewController extends Controller
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
        $overviews=Overview::all();
        $websiteLang=$this->websiteLang;
        return view('admin.overview.index',compact('overviews','websiteLang'));
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
            'qty'=>'required',
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'qty.required' => $this->errorTexts->where('id',65)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);



        $overview=new Overview();
        $overview->name=$request->name;
        $overview->qty=$request->qty;
        $overview->status=$request->status;
        $overview->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.overview.index')->with($notification);
    }


    public function update(Request $request, Overview $overview)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'name'=>'required',
            'qty'=>'required',
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'qty.required' => $this->errorTexts->where('id',65)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $overview->name=$request->name;
        $overview->qty=$request->qty;
        $overview->status=$request->status;
        $overview->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.overview.index')->with($notification);
    }


    public function destroy(Overview $overview)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $overview->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.overview.index')->with($notification);
    }

    public function changeStatus($id){
        $overview=Overview::find($id);
        if($overview->status==1){
            $overview->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $overview->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $overview->save();
        return response()->json($message);

    }

    public function overviewVideo(){
        $video=OverviewVideo::first();
        $websiteLang=$this->websiteLang;
        if($video){
            return view('admin.overview.video.index',compact('video','websiteLang'));
        }else{
            return view('admin.overview.video.create',compact('video','websiteLang'));
        }


    }

    public function overviewVideoUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'video_link'=>'required'
        ]);

        $video=OverviewVideo::find($id);
        $video->video_link=$request->video_link;
        $video->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function overviewVideoStore(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'video_link'=>'required'
        ]);

        $video= new OverviewVideo();
        $video->video_link=$request->video_link;
        $video->save();
        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }
}
