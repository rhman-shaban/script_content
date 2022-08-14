<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Str;
use Storage;
use File;
use Auth;
class BlogController extends Controller
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
        $blogs=Blog::with('category')->get();
        $websiteLang=$this->websiteLang;
        return view('admin.blog.blog.index',compact('blogs','websiteLang'));
    }


    public function create()
    {
        $categories=BlogCategory::all();
        $websiteLang=$this->websiteLang;
        return view('admin.blog.blog.create',compact('categories','websiteLang'));
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
            'title'=>'required|unique:blogs',
            'slug'=>'required|unique:blogs',
            'category'=>'required',
            'image'=>'required',
            'description'=>'required',
            'short_description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'category.required' => $this->errorTexts->where('id',20)->first()->custom_text,
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'short_description.required' => $this->errorTexts->where('id',29)->first()->custom_text,
            'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);



        $image=$request->image;
        $extention=$image->getClientOriginalExtension();

         // for small image
        $name= 'blog-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $thumbnail_path='uploads/custom-images/'.$name;


        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($thumbnail_path));

        // large image
        $name= 'blog-feature-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $feature_path='uploads/custom-images/'.$name;

        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($feature_path));

        $admin=Auth::guard('admin')->user();
        $blog=new Blog();
        $blog->admin_id=$admin->id;
        $blog->title=$request->title;
        $blog->slug=$request->slug;
        $blog->blog_category_id=$request->category;
        $blog->description=$request->description;
        $blog->short_description=$request->short_description;
        $blog->thumbnail_image=$thumbnail_path;
        $blog->feature_image=$feature_path;
        $blog->status=$request->status;
        $blog->show_homepage=$request->show_homepage;
        $blog->seo_title=$request->seo_title ? $request->seo_title : 'blog seo title';
        $blog->seo_description=$request->seo_description ? $request->seo_description : 'blog seo description';
        $blog->save();


        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }


    public function edit(Blog $blog)
    {
        $categories=BlogCategory::all();
        $websiteLang=$this->websiteLang;
        return view('admin.blog.blog.edit',compact('categories','blog','websiteLang'));
    }


    public function update(Request $request, Blog $blog)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'title'=>'required|unique:blogs,title,'.$blog->id,
            'slug'=>'required|unique:blogs,slug,'.$blog->id,
            'category'=>'required',
            'description'=>'required',
            'short_description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'category.required' => $this->errorTexts->where('id',20)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
            'short_description.required' => $this->errorTexts->where('id',29)->first()->custom_text,
            'show_homepage.required' => $this->errorTexts->where('id',39)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);


        $admin=Auth::guard('admin')->user();
        // for thumbnail image
        if($request->file('image')){
            $old_thumbnail=$blog->thumbnail_image;
            $old_feature=$blog->feature_image;

            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            // small image
            $name= 'blog-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $thumbnail_path='uploads/custom-images/'.$name;

            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($thumbnail_path));

            // large image
            $name= 'blog-feature-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $feature_path='uploads/custom-images/'.$name;

            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($feature_path));

            $blog->admin_id=$admin->id;
            $blog->title=$request->title;
            $blog->slug=$request->slug;
            $blog->description=$request->description;
            $blog->short_description=$request->short_description;
            $blog->blog_category_id=$request->category;
            $blog->status=$request->status;
            $blog->seo_title=$request->seo_title ? $request->seo_title : 'blog seo title';
            $blog->seo_description=$request->seo_description ? $request->seo_description: 'blog seo description';
            $blog->show_homepage=$request->show_homepage;
            $blog->feature_image=$feature_path;
            $blog->thumbnail_image=$thumbnail_path;
            $blog->save();

            if(File::exists(public_path($old_thumbnail)))unlink(public_path($old_thumbnail));
            if(File::exists(public_path($old_feature)))unlink(public_path($old_feature));

        }else{
            $blog->admin_id=$admin->id;
            $blog->title=$request->title;
            $blog->slug=$request->slug;
            $blog->description=$request->description;
            $blog->short_description=$request->short_description;
            $blog->blog_category_id=$request->category;
            $blog->status=$request->status;
            $blog->seo_title=$request->seo_title ? $request->seo_title : 'blog seo title';
            $blog->seo_description=$request->seo_description ? $request->seo_description: 'blog seo description';
            $blog->show_homepage=$request->show_homepage;
            $blog->save();
        }

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog.index')->with($notification);

    }


    public function destroy(Blog $blog)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
            // end

        $old_thumbnail=$blog->thumbnail_image;
        $old_feature=$blog->feature_image;
        $blog->delete();

        if(File::exists(public_path($old_thumbnail)))unlink(public_path($old_thumbnail));
        if(File::exists(public_path($old_feature)))unlink(public_path($old_feature));

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog.index')->with($notification);
    }

    // manage blog status
    public function changeStatus($id){
        $blog=Blog::find($id);
        if($blog->status==1){
            $blog->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $blog->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $blog->save();
        return response()->json($message);

    }


}
