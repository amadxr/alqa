<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWallpaper;
use App\Http\Resources\Wallpaper as WallpaperResource;
use App\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WallpaperController extends Controller
{
    public function store(StoreWallpaper $request)
    {
        $path = Storage::putFileAs(
            'display', 
            $request->file('wallpaper'),
            'wallpaper.jpg',
            ['visibility' => 'public']
        );

        $wallpaper = Wallpaper::firstOrNew();
        $wallpaper->url = $path;
        $wallpaper->save();

        $wallpaper->url = Storage::url($wallpaper->url);

        return new WallpaperResource($wallpaper);
    }

    public function show()
    {
        $wallpaper = Wallpaper::first();
        $wallpaper->url = Storage::url($wallpaper->url);

        return new WallpaperResource($wallpaper);
    }
}
