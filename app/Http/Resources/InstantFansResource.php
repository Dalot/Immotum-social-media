<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstantFansResource extends JsonResource
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
            'title' => $this->resource['name'],
            'category_name' => $this->resource['category'],
            'original_price' => $this->resource['rate'],
            'min' => $this->resource['min'],
            'max' => $this->resource['max']
        ];
        
    }
}
