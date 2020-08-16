<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}
