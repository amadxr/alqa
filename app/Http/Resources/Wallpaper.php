<?php

namespace App\Http\Resources;

use App\Http\Resources\Image as ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Wallpaper extends JsonResource
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
            'active' => $this->active,
            'image' => new ImageResource($this->whenLoaded('image')),
        ];
    }
}
