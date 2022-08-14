<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingCategory extends Model
{
    protected $fillable=[
        'name','icon','image','status','icon_image','slug'
    ];

    public function listings(){
        return $this->hasMany(Listing::class);
    }
}
