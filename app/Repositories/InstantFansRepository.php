<?php
namespace App\Repositories;

use App\Product;

class InstantFansRepository
{
    public function UpdateOrCreate(object $chunks)
    {
        $aResponse = [];

            foreach ($chunks as $chunk)
            {
               foreach($chunk as $row)
               {
                   Product::updateOrCreate( ['title' => $row['title'] ], 
                    [
                        'original_price' =>  $row['original_price'], 
                        'max'  => $row['max'],
                        'min' =>  $row['min'],
                        'category_name' => $row['category_name'],
                        'description' => $row['description'],
                        'our_price' =>  $row['our_price'],
                        'type' => $row['type']
                    ]);
                    
                    $aResponse[] = [
                        'status' => (bool) $row,
                        'data'   => $row,
                        'message' => $row ? 'Product Created!' : 'Error Creating Product'
                    ];
                  
               }
            }
            
        return $aResponse;
    }
}