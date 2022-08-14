<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Listing;
use App\ListingSchedule;
use App\ManageText;
use App\Day;
use Auth;

use App\NotificationText;
use App\ValidationText;
class StaffListingScheduleController extends Controller
{


    public $notify;
    public $errorTexts;
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:staff');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }


    public function index($id){
        $listing=Listing::find($id);
        $websiteLang=$this->websiteLang;
        if($listing){
            $user=Auth::guard('staff')->user();
            if($user->author_id==$listing->admin_id){
                $schedules=ListingSchedule::where('listing_id',$id)->get();
                $confirmNotify=$this->notify->where('id',32)->first()->custom_text;
                return view('staff.listing.schedule',compact('listing','schedules','websiteLang','confirmNotify'));
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('staff.listing.index')->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('staff.listing.index')->with($notification);
        }


    }

    public function create($id){
        $days=Day::all();
        $listing=Listing::find($id);
        if($listing){
            $user=Auth::guard('staff')->user();
            if($user->author_id==$listing->admin_id){
                $websiteLang=$this->websiteLang;
                return view('staff.listing.create-schedule',compact('listing','days','websiteLang'));
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('admin.listing.index')->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('admin.my.listing')->with($notification);
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

            return redirect()->route('staff.listing.schedule',$id)->with($notification);
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',18)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('staff.listing.schedule',$id)->with($notification);
        }

    }

    public function edit($id){
        $days=Day::all();
        $schedule=ListingSchedule::find($id);
        if($schedule){
            $listing=Listing::find($schedule->listing_id);
            if($listing){
                if($listing->user_type==1){
                    $websiteLang=$this->websiteLang;
                    return view('staff.listing.edit-schedule',compact('listing','days','schedule','websiteLang'));
                }else{
                    $notification=array(
                        'messege'=>$this->notify->where('id',7)->first()->custom_text,
                        'alert-type'=>'error'
                    );

                    return redirect()->route('staff.listing.index')->with($notification);
                }
            }else{
                $notification=array(
                    'messege'=>$this->notify->where('id',7)->first()->custom_text,
                    'alert-type'=>'error'
                );

                return redirect()->route('staff.listing.index')->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('staff.listing.index')->with($notification);
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

        return redirect()->route('staff.listing.schedule',$request->listing_id)->with($notification);


    }

    public function destroy($id){

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
