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
        $our_price =  $this->resource['rate'] * 1.3;
        
        
        return [
            'title' => $this->resource['name'],
            'category_name' => $this->resource['category'],
            'original_price' => floatval($this->resource['rate']),
            'our_price' => floatval($our_price),
            'min' => $this->resource['min'],
            'max' => $this->resource['max'],
            'service_id' => $this->resource['service'],
            'description' => $this->resource['description'],
            'type' => $this->resource['type']
        ];
        
    }
}
