<?php

namespace App\API;

use GuzzleHttp\Client;

class InstantFans
{
    
    protected $key;
    
    
    public function __construct($key)
    {
        $this->key = $key;
    }
    
    public function getServices()
    {
        $client = new Client();
         
        $res = $client->request('POST', 'https://instant-fans.com/api/v2',
        [
            'query' =>
            [
                'key' => env('INSTANT_FANS_API_KEY'),
                'action' => 'services'
            ]
        ]);
        
        $results = json_decode( $res->getBody(), true );
        $results = array_slice($results, 0, 5);
        
        return $results;
    }
    
    
    
    
    public function getStatuses($arr)
    {
        $client = new Client();
        $res = $client->request('POST', 'https://instant-fans.com/api/v2',
        [
            'query' =>
            [
                'key' => env('INSTANT_FANS_API_KEY'),
                'action' => 'status',
                'orders' => implode(",", $arr)
            ]
        ]);
            
        $res = json_decode( $res->getBody(), true );
        
        return $res;
    }
    
    
    
    
    
    
    
}