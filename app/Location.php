<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable=[
        'location','status','icon','image','slug'
    ];

    public function listings(){
        return $this->hasMany(Listing::class);
    }
}
