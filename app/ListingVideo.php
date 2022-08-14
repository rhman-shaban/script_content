<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingVideo extends Model
{
    protected $fillable=[
        'listing_id','video_link'
    ];
}
