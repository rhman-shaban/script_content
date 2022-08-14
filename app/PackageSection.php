<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageSection extends Model
{
    protected $fillable=[
        'header','description','show_homepage','section_name','content_quantity','icon'
    ];
}
