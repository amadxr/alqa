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
            'description' => $this->description,
            'width' => $this->width,
            'length' => $this->length,
            'depth' => $this->depth,
            'sku' => $this->sku,
            'price' => $this->price,
            'images' => ImageResource::collection($this->images),
        ];
    }
}
