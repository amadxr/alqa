<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function imageArea()
    {
        return $this->hasOne('App\ImageArea');
    }
}
