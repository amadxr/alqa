<?php

namespace App\Http\Controllers;

use App\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WallpaperController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'wallpaper' => 'required|image',
        ]);

        $path = Storage::putFileAs(
            'display', 
            $request->file('wallpaper'),
            'wallpaper.jpg',
            ['visibility' => 'public']
        );

        $wallpaper = Wallpaper::firstOrNew();
        $wallpaper->url = $path;
        $wallpaper->save();

        return redirect()->back()->with('status', 'Wallpaper added successfuly!');
    }
}
