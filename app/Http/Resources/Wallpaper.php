<?php

namespace App\Http\Resources;

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
            'url' => $this->url,
            'active' => $this->active,
        ];
    }
}
