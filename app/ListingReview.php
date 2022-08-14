<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingReview extends Model
{
    protected $fillable=[
    'user_id','listing_id','comment','rating','status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }


}
