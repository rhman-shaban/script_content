<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Blog;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class BlogCategoryController extends Controller
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
        $categories=BlogCategory::all();
        $blogs=Blog::all();
        $websiteLang=$this->websiteLang;
        return view('admin.blog.category.index',compact('categories','blogs','websiteLang'));
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
            'name'=>'required|unique:blog_categories',
            'slug'=>'required|unique:blog_categories',
            'status'=>'required'
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'name.unique' => $this->errorTexts->where('id',44)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        BlogCategory::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'status'=>$request->status,
        ]);

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog-category.index')->with($notification);
    }



    public function update(Request $request, BlogCategory $blogCategory)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'name'=>'required|unique:blog_categories,name,'.$blogCategory->id,
            'slug'=>'required|unique:blog_categories,slug,'.$blogCategory->id,
            'status'=>'required'
        ];

        $customMessages = [
            'name.required' => $this->errorTexts->where('id',4)->first()->custom_text,
            'name.unique' => $this->errorTexts->where('id',44)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);


        $blogCategory->name=$request->name;
        $blogCategory->slug=$request->slug;
        $blogCategory->status=$request->status;
        $blogCategory->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $blogCategory->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    public function changeStatus($id){
        $category=BlogCategory::find($id);
        if($category->status==1){
            $category->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $category->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $category->save();
        return response()->json($message);

    }
}
