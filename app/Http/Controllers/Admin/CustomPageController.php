<?php

namespace App\Http\Controllers\Admin;

use App\CustomPage;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class CustomPageController extends Controller
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
        $pages=CustomPage::all();
        $websiteLang=$this->websiteLang;
        return view('admin.custome-page.index',compact('pages','websiteLang'));
    }


    public function create()
    {
        $websiteLang=$this->websiteLang;
        return view('admin.custome-page.create',compact('websiteLang'));
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
            'page_name'=>'required|unique:custom_pages',
            'description'=>'required',
        ];

        $customMessages = [
            'page_name.required' => $this->errorTexts->where('id',92)->first()->custom_text,
            'page_name.unique' => $this->errorTexts->where('id',93)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $page=new CustomPage();
        $page->page_name=$request->page_name;
        $page->slug=Str::slug($request->page_name);
        $page->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $page->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $page->description=$request->description;
        $page->status=$request->status;
        $page->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.custom-page.index')->with($notification);
    }



    public function edit(CustomPage $customPage)
    {
        $page=$customPage;
        $websiteLang=$this->websiteLang;
        return view('admin.custome-page.edit',compact('page','websiteLang'));
    }


    public function update(Request $request, CustomPage $customPage)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $rules = [
            'page_name'=>'required|unique:custom_pages,page_name,'.$customPage->id,
            'description'=>'required',
        ];

        $customMessages = [
            'page_name.required' => $this->errorTexts->where('id',92)->first()->custom_text,
            'page_name.unique' => $this->errorTexts->where('id',93)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $customPage->page_name=$request->page_name;
        $customPage->slug=Str::slug($request->page_name);
        $customPage->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $customPage->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $customPage->description=$request->description;
        $customPage->status=$request->status;
        $customPage->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.custom-page.index')->with($notification);
    }


    public function destroy(CustomPage $customPage)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $customPage->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.custom-page.index')->with($notification);
    }


    public function changeStatus($id){
        $page=CustomPage::find($id);
        if($page->status==1){
            $page->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $page->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $page->save();
        return response()->json($message);

    }
}
