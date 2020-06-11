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
        $wallpaper = Wallpaper::firstOrNew();
        $wallpaper->active = $request->data['wallpaper']['active'];
        $success = 'Wallpaper updated successfully!';

        if (!is_null($request->file)) {
            $path = Storage::putFileAs(
                'display', 
                $request->file,
                'wallpaper.jpg',
                'public'
            );

            if (is_null($wallpaper->url)) {
                $success = 'Wallpaper created successfully!';
            }

            $wallpaper->url = $path;
        }

        if (is_null($wallpaper->url)) {
            return response()->json([
                'errors' => [
                    'file' => [
                        'The image file is required if a wallpaper has not been created yet.'
                    ]
                ],
            ], 422);
        }

        $wallpaper->save();
        $wallpaper->url = Storage::url($wallpaper->url);

        return response()->json([
            'data' => [
                'wallpaper' => new WallpaperResource($wallpaper),
            ],
            'messages' => [
                'success' => $success,
            ]
        ], 200);
    }

    public function show()
    {
        $wallpaper = Wallpaper::first();

        if (!empty($wallpaper)) {
            $wallpaper->url = Storage::url($wallpaper->url);
            $info = 'Wallpaper fetched successfully!';
        } else {
            $info = 'There are no wallpapers yet.';
        }

        return response()->json([
            'data' => [
                'wallpaper' => new WallpaperResource($wallpaper),
            ],
            'messages' => [
                'info' => $info,
            ]
        ], 200);
    }
}
