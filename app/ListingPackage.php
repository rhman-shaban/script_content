<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingPackage extends Model
{
    protected $fillable=[
        'package_name','package_type','price','number_of_days','number_of_aminities','number_of_photo','number_of_video','status','is_featured','number_of_listing','number_of_feature_listing'
    ];


    public function listings(){
        return $this->hasMany(Listing::class);
    }
}
