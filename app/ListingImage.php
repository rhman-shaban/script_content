<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    protected $fillable=[
        'listing_id','small_image','large_image'
    ];
}
