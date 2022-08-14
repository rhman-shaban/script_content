<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Listing;
use App\ListingSchedule;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
use App\Navigation;
use App\Day;
use Auth;
class ListingScheduleController extends Controller
{
    public $notify;
    public $errorTexts;
    public $websiteLang;
    public function __construct()
    {
        $this->middleware('auth:web');
        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;
    }
    public function index($id){
        $listing=Listing::find($id);
        $user=Auth::guard('web')->user();
        if($listing){
            if($listing->user_type==0){
                if($listing->user_id==$user->id){
                    $schedules=ListingSchedule::where('listing_id',$id)->get();
                    $notify=$this->notify->where('id',32)->first()->custom_text;
                    $websiteLang=$this->websiteLang;
                    $menus=Navigation::all();
                    return view('user.profile.listing.schedule.index',compact('listing','schedules','notify','websiteLang','menus'));
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',7)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('user.my.listing')->with($notification);
                }

            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('user.my.listing')->with($notification);
            }

        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.my.listing')->with($notification);
        }


    }

    public function create($id){
        $days=Day::all();
        $listing=Listing::find($id);
        $user=Auth::guard('web')->user();
        if($listing){
            if($listing->user_type==0){
                if($listing->user_id==$user->id){
                    $websiteLang=$this->websiteLang;
                    $menus=Navigation::all();
                    return view('user.profile.listing.schedule.create',compact('listing','days','websiteLang','menus'));
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',7)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('user.my.listing')->with($notification);
                }
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('user.my.listing')->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.my.listing')->with($notification);
        }


    }


    public function store(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'status'=>'required',
        ];

        $customMessages = [
            'day.required' => $this->errorTexts->where('id',31)->first()->custom_text,
            'start_time.required' => $this->errorTexts->where('id',32)->first()->custom_text,
            'end_time.required' => $this->errorTexts->where('id',33)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        $dayExist=ListingSchedule::where(['day_id'=>$request->day,'listing_id'=>$id])->count();
        if($dayExist ==0){
            $schedule=new ListingSchedule();
            $schedule->listing_id=$id;
            $schedule->day_id=$request->day;
            $schedule->start_time=$request->start_time;
            $schedule->end_time=$request->end_time;
            $schedule->status=$request->status;
            $schedule->is_open=$request->status==1 ? 1 : 0;
            $schedule->save();
            $notification=array(
                'messege'=>$this->notify->where('id',9)->first()->custom_text,
                'alert-type'=>'success'
            );

            return redirect()->route('user.listing.schedule.index',$id)->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',18)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.listing.schedule.index',$id)->with($notification);
        }

    }

    public function edit($id){
        $days=Day::all();
        $schedule=ListingSchedule::find($id);
        if($schedule){
            $listing=Listing::find($schedule->listing_id);
            if($listing){
                if($listing->user_type==0){
                    $websiteLang=$this->websiteLang;
                    $menus=Navigation::all();
                    return view('user.profile.listing.schedule.edit',compact('listing','days','schedule','websiteLang','menus'));
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',7)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('user.my.listing')->with($notification);
                }
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('user.my.listing')->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.my.listing')->with($notification);
        }



    }


    public function update(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'start_time'=>'required',
            'end_time'=>'required',
            'status'=>'required',
        ];

        $customMessages = [
            'start_time.required' => $this->errorTexts->where('id',32)->first()->custom_text,
            'end_time.required' => $this->errorTexts->where('id',33)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        $schedule=ListingSchedule::find($id);
        $schedule->start_time=$request->start_time;
        $schedule->end_time=$request->end_time;
        $schedule->status=$request->status;
        $schedule->is_open=$request->status==1 ? 1 : 0;
        $schedule->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('user.listing.schedule.index',$request->listing_id)->with($notification);


    }


    public function delete($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $schedule=ListingSchedule::find($id);
        $schedule->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }


    public function changeStatus($id){
        $schedule=ListingSchedule::find($id);
        if($schedule->status==1){
            $schedule->status=0;
            $schedule->is_open=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $schedule->status=1;
            $schedule->is_open=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $schedule->save();
        return response()->json($message);

    }
}
