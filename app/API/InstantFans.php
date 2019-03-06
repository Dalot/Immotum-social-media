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
    
    public function addOrder($item)
    {
        $client = new Client();
        
        $order_details = $item["order_details"];
        $type = $item["type"];
        
        
        $query = [];
       
        $query["service"] = (int)$item["service_id"];
        $query["link"] = $order_details["link"];
        
        switch ($type) {
            case "Default":
                $query["quantity"] = 100;
                break;
            case "Package":
                $query;
                break;
            case "Custom Comments":
                $query['comments'] = $order_details["comments"];
                break;
            case "Mentions Custom List":
                 $query['usernames'] = $order_details["usernames"];
                break;
            case "Mentions User Followers":
                 $query['quantity'] =  $order_details["qty_max"];
                 $query['comments'] = $order_details["comments"]; // Just one username URL to scrape followers from

                break;
            case "Comment Likes":
                 $query['quantity'] =  $order_details["qty_max"];
                 $query['username'] = $order_details["usernames"]; // Just one username Username of the comment Owner
                break;
            case "Subscriptions":
                 $query['username'] = $order_details["usernames"]; // Just one username Username of the comment Owner
                 $query['min'] = $order_details["qty_min"];
                 $query['max'] = $order_details["qty_max"];
                 $query['posts'] = $order_details["posts"];
                 $query['delay'] = $order_details["delay"];
                 $query['expiry'] = $order_details["expiry"];
                break;
        }
        
       
        $res = $client->request('POST', 'https://instant-fans.com/api/v2',
        [
            'query' =>
            [
                'key' => env('INSTANT_FANS_API_KEY'),
                'action' => 'add',
                $query
            ]
        ]);
        
        return $res;
    
    }
    
    
    
    
    
    
    
}

/*
# Default 
array(
    'service' => 1, 
    'link' => 'http://example.com/test', 
    'quantity' => 100
); 

link -> required
#comments
comments

#mention comments
usernames
username

#Drip-feed
runs
interval

#subscriptions
min 
max  
posts
delay
expiry 

#comment likes
username

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