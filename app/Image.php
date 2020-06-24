<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
