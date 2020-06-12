<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWallpaper;
use App\Http\Resources\Wallpaper as WallpaperResource;
use App\Image;
use App\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WallpaperController extends Controller
{
    public function store(StoreWallpaper $request)
    {
        $wallpaper = Wallpaper::firstOrNew();
        $wallpaper->active = $request->data['wallpaper']['active'];
        $wallpaper->save();
        $success = 'Wallpaper updated successfully!';
        $uploadedImage = $wallpaper->image;

        if (!is_null($request->file)) {
            $path = Storage::putFileAs(
                'display', 
                $request->file,
                'wallpaper.jpg',
                'public'
            );

            if (is_null($uploadedImage)) {
                $uploadedImage = new Image;
                $uploadedImage->display = 'wall';
                $uploadedImage->url = $path;
                $uploadedImage->imageable()->associate($wallpaper);
                $uploadedImage->save();
                $success = 'Wallpaper created successfully!';
            }
        }

        if (is_null($uploadedImage)) {
            return response()->json([
                'errors' => [
                    'file' => [
                        'The image file is required if a wallpaper has not been created yet.'
                    ]
                ],
            ], 422);
        }

        return response()->json([
            'data' => [
                'wallpaper' => new WallpaperResource($wallpaper->load('image')),
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
            $info = 'Wallpaper fetched successfully!';
            $wallpaper = new WallpaperResource($wallpaper->load('image'));
        } else {
            $info = 'There are no wallpapers yet.';
            $wallpaper = null;
        }

        return response()->json([
            'data' => [
                'wallpaper' => $wallpaper,
            ],
            'messages' => [
                'info' => $info,
            ]
        ], 200);
    }
}
