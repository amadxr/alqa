<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageArea extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function artwork()
    {
        return $this->belongsTo('App\Artwork');
    }
}
