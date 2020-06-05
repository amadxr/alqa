<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wallpaper as WallpaperResource;
use App\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WallpaperController extends Controller
{
    public function show()
    {
        $wallpaper = Wallpaper::first();
        $wallpaper->url = Storage::url($wallpaper->url);

        return new WallpaperResource($wallpaper);
    }
}
