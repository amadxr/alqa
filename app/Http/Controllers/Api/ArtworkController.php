<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artwork as ArtworkResource;
use App\Image;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::all();

        if ($artworks->isNotEmpty()) {
            $info = 'Artworks fetched successfully!';
            $artworks = ArtworkResource::collection($artworks);
        } else {
            $info = 'There are no artworks yet.';
            $artworks = null;
        }

        return response()->json([
            'data' => [
                'artworks' => $artworks,
            ],
            'messages' => [
                'info' => $info,
            ]
        ], 200);
    }
}
