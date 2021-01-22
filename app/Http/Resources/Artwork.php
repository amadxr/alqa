<?php

namespace App\Http\Resources;

use App\Http\Resources\Image as ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Artwork extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'origin' => $this->origin,
            'text1' => $this->text1,
            'highlightedText' => $this->highlighted_text,
            'text2' => $this->text2,
            'text3' => $this->text3,
            'text4' => $this->text4,
            'width' => $this->width,
            'height' => $this->height,
            'depth' => $this->depth,
            'sku' => $this->sku,
            'price' => $this->price_in_cents / 100,
            'forSale' => $this->for_sale,
            'carouselImages' => ImageResource::collection($this->images
                                    ->where('display', 'carousel')),
            'coverImage' => new ImageResource($this->images
                                    ->firstWhere('display', 'cover')),
            'flyerImages' => ImageResource::collection($this->images
                                    ->where('display', 'flyer')),
        ];
    }
}
