<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id','listing_package_id','purchase_date','expired_day','expired_date','payment_method','transaction_id','payment_status','status','amount'
    ];


    public function listingPackage(){
        return $this->belongsTo(ListingPackage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
