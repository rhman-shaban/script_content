<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Listing;
use App\ManageText;
class StaffDashboardController extends Controller
{

    public $websiteLang;
    public function __construct()
    {
        $this->middleware('auth:staff');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;
    }

    public function dashboard(){
        $user=Auth::guard('staff')->user();
        $author_id=$user->author_id;
        $listings=Listing::where('admin_id',$author_id)->orderBy('id','desc')->get();
        $websiteLang=$this->websiteLang;
        return view('staff.dashboard',compact('listings','websiteLang'));
    }
}
