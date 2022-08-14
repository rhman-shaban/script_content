<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogComment;
use App\ManageText;
use App\NotificationText;
class BlogCommentController extends Controller
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
    }

    public function allComments(){
        $comments=BlogComment::all();
        $websiteLang=$this->websiteLang;
        $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
        return view('admin.blog.comment.index',compact('comments','websiteLang','confirmNotify'));
    }

    public function deleteComment($id){

          // project demo mode check
          if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        BlogComment::destroy($id);
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }

    // manage comment status
    public function changeStatus($id){
        $comment=BlogComment::find($id);
        if($comment->status==1){
            $comment->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $comment->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $comment->save();
        return response()->json($message);

    }
}
