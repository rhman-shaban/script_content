<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingAminity extends Model
{
    protected $fillable=[
        'listing_id','aminity_id','status'
    ];

    public function aminity(){
        return $this->belongsTo(Aminity::class);
    }


    public function listing(){
        return $this->belongsTo(Listing::class);
    }
}
