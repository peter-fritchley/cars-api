<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->getId(),
            'make' => $this->resource->getMake(),
            'model' => $this->resource->getModelName(),
            'build_date' => $this->resource->getBuildDate()->format('Y-m-d'),
            'colour' => new ColourResource($this->resource->getColour())
        ];
    }
}