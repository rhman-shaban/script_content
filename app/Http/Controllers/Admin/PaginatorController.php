<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomPaginator;
use App\ManageText;
use App\NotificationText;
class PaginatorController extends Controller
{

    public $notify;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $notify=NotificationText::all();
        $this->notify=$notify;
    }


    public function index(){
        $paginators=CustomPaginator::all();
        $websiteLang=ManageText::all();
        return view('admin.paginator.index',compact('paginators','websiteLang'));
    }

    public function update(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        foreach($request->qtys as $index => $qty){
            if($request->qtys[$index]==''){
                $notification=array(
                    'messege'=>$this->notify->where('id',33)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $paginator=CustomPaginator::find($request->ids[$index]);
            $paginator->qty=$request->qtys[$index];
            $paginator->save();
        }
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
