<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtwork;
use App\Http\Requests\UpdateArtwork;
use App\Http\Resources\Artwork as ArtworkResource;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function show($id)
    {
        $artwork = Artwork::find($id);

        if (is_null($artwork)) {
            $info = 'Artwork not found.';
        } else {
            $info = 'Artwork fetched successfully!';
            $artwork = new ArtworkResource($artwork);
        }

        return response()->json([
            'data' => [
                'artwork' => $artwork,
            ],
            'messages' => [
                'info' => $info,
            ]
        ], 200);
    }

    public function store(StoreArtwork $request)
    {
        $artworkData = $request->data['artwork'];

        $artworkArray = [
            'name' => $artworkData['name'],
            'origin' => $artworkData['origin'],
            'description' => $artworkData['description'],
            'width' => $artworkData['width'],
            'length' => $artworkData['length'],
            'depth' => $artworkData['depth'],
            'sku' => $artworkData['sku'],
            'price_in_cents' => $artworkData['price'],
        ];

        $artwork = Artwork::create($artworkArray);

        foreach ($request->files->get('files') as $key => $value) {
            $path = Storage::putFileAs(
                'artworks/' . $artwork->sku,
                $value,
                $artwork->sku . '-' . $key . '.jpg',
                'public'
            );

            $uploadedImage = new Image;
            $uploadedImage->display = 'flyer';
            $uploadedImage->url = $path;
            $uploadedImage->imageable()->associate($artwork);
            $uploadedImage->save();
        }

        $success = "Artwork successfully registered!";

        return response()->json([
            'data' => [
                'artwork' => new ArtworkResource($artwork),
            ],
            'messages' => [
                'success' => $success,
            ]
        ], 200);
    }

    public function update(UpdateArtwork $request)
    {
        $artworkData = $request->data['artwork'];

        $artworkArray = [
            'name' => $artworkData['name'],
            'origin' => $artworkData['origin'],
            'description' => $artworkData['description'],
            'width' => $artworkData['width'],
            'length' => $artworkData['length'],
            'depth' => $artworkData['depth'],
            'price' => $artworkData['price'],
        ];

        $artwork = Artwork::find($artworkData['id']);

        if (is_null($artwork)) {
            return response()->json([
                'errors' => [
                    'id' => [
                        'The artwork being updated does not exist in the database.'
                    ]
                ],
            ], 422);
        } else {
            $artwork->update($artworkArray);
            $success = "Artwork successfully updated!";
        }

        return response()->json([
            'data' => [
                'artwork' => new ArtworkResource($artwork),
            ],
            'messages' => [
                'success' => $success,
            ]
        ], 200);
    }

    public function delete($id)
    {
        $artwork = Artwork::find($id);

        if (is_null($artwork)) {
            return response()->json([
                'errors' => [
                    'id' => [
                        'The artwork being deleted does not exist in the database.'
                    ]
                ],
            ], 422);
        } else {
            $artwork->delete();
            $success = "Artwork successfully deleted.";
        }

        return response()->json([
            'messages' => [
                'success' => $success,
            ]
        ], 200);
    }
}
