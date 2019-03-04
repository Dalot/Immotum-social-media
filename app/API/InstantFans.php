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
    
    public function createOrder($data)
    {
        $client = new Client();
        $res = $client->request('POST', 'https://instant-fans.com/api/v2',
        [
            'query' =>
            [
                'key' => env('INSTANT_FANS_API_KEY'),
                'action' => 'add',
                $data
            ]
        ]);
        
        return json_decode($this->connect($post));
    
    }
    
    
    
    
    
    
    
}

/*
# Default 
array(
    'service' => 1, 
    'link' => 'http://example.com/test', 
    'quantity' => 100
); 

# Custom Comments
array(
    'service' => 1, 
    'link' => 'http://example.com/test', 
    'comments' => "good pic\ngreat photo\n:)\n;)"
); 


# Mentions Custom List
array(
    'service' => 1, 
    'link' => 'http://example.com/test', 
    'usernames' => "test\nexample\nfb"
);


# Mentions User Followers
array(
    'service' => 1, 
    'link' => 'http://example.com/test', 
    'quantity' => 1000, 
    'username'=>"test"
); 
    
# Package
array(
    'service' => 1, 
    'link' => 'http://example.com/test'
); 

# Drip-feed
array(
    'service' => 1, 
    'link' => 'http://example.com/test', 
    'quantity' => 100, 
    'runs' => 10, 
    'interval' => 60
);

# Subscriptions
array(
    'service' => 1, 
    'username' => 'username', 
    'min' => 100, 
    'max' => 110, 
    'posts' => 0,
    'delay' => 30, 
    'expiry' => '11/11/2019'
); 


# Comment Likes
array(
    'service' => 1, 
    'link' => 'http://example.com/test', 
    'quantity' => 100, 
    'username' => "test"
); 
*/