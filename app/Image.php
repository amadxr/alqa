<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($image) {
            Storage::delete($image->path);
        });
    }
}
