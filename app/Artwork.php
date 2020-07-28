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

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($user) {
            $user->images()->each(function ($image) {
                $image->delete();
            });
        });
    }

    public function getPriceAttribute()
    {
        return $this->price_in_cents / 100;
    }
}
