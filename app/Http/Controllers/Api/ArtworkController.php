<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArtworkRequest;
use App\Http\Resources\Artwork as ArtworkResource;
use App\Image;
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

    public function store(ArtworkRequest $request)
    {
        $artworkData = $request->data['artwork'];

        $artworkArray = [
            'name' => $artworkData['name'],
            'origin' => $artworkData['origin'],
            'text1' => $artworkData['text1'],
            'highlighted_text' => $artworkData['highlightedText'],
            'text2' => $artworkData['text2'],
            'text3' => $artworkData['text3'],
            'text4' => $artworkData['text4'],
            'width' => $artworkData['width'],
            'height' => $artworkData['height'],
            'depth' => $artworkData['depth'],
            'sku' => $artworkData['sku'],
            'price_in_cents' => $artworkData['price'] * 100,
            'for_sale' => $artworkData['forSale'],
        ];

        $artwork = Artwork::create($artworkArray);

        foreach ($request->files->get('carouselImages') as $key => $value) {
            $path = Storage::putFileAs(
                'artworks/' . $artwork->sku . '/carousel',
                $value,
                $artwork->sku . '-' . 'carousel-' . $key . '.jpg',
                'public'
            );

            $uploadedImage = new Image;
            $uploadedImage->display = 'carousel';
            $uploadedImage->url = $path;
            $uploadedImage->imageable()->associate($artwork);
            $uploadedImage->save();
        }

        $path = Storage::putFileAs(
            'artworks/' . $artwork->sku . '/cover',
            $request->files->get('coverImage'),
            $artwork->sku . '-' . 'cover.jpg',
            'public'
        );

        $uploadedImage = new Image;
        $uploadedImage->display = 'cover';
        $uploadedImage->url = $path;
        $uploadedImage->imageable()->associate($artwork);
        $uploadedImage->save();

        foreach ($request->files->get('flyerImages') as $key => $value) {
            $path = Storage::putFileAs(
                'artworks/' . $artwork->sku . '/flyer',
                $value,
                $artwork->sku . '-' . 'flyer-' . $key . '.jpg',
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

    public function update(ArtworkRequest $request, Artwork $artwork)
    {
        $artworkData = $request->data['artwork'];

        $artworkArray = [
            'name' => $artworkData['name'],
            'origin' => $artworkData['origin'],
            'description' => $artworkData['description'],
            'width' => $artworkData['width'],
            'length' => $artworkData['length'],
            'depth' => $artworkData['depth'],
            'price_in_cents' => $artworkData['price'] * 100,
            'for_sale' => $artworkData['forSale'],
        ];

        $artwork->update($artworkArray);
        $success = "Artwork successfully updated!";

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
