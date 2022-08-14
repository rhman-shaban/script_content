<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingSchedule extends Model
{
    protected $fillable=[
        'listing_id','day_id','is_open','start_time','end_time','status'
    ];

    public function day(){
        return $this->belongsTo(Day::class);
    }
}
