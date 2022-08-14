<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\NotificationText;

class TextController extends Controller
{
    public $notify;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $notify=NotificationText::all();
        $this->notify=$notify;
    }

    public function index(){
        $manageTexts=ManageText::all();
        $websiteLang=ManageText::all();
        return view('admin.manage-text.index',compact('manageTexts','websiteLang'));
    }

    public function update(Request $request){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        foreach($request->customs as $index => $custom){
            if($request->customs[$index]==''){
                $notification=array(
                    'messege'=>$this->notify->where('id',33)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $manageText=ManageText::find($request->ids[$index]);
            $manageText->custom_text=$request->customs[$index];
            $manageText->save();
        }
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
