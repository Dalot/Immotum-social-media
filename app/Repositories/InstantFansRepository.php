<?php
namespace App\Repositories;

use App\Product;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Order;
use App\API\InstantFans;

class InstantFansRepository
{
    
    public function __construct(InstantFans $InstantFans)
    {
        $this->InstantFans = $InstantFans;
    }
    
    
    public function UpdateOrCreate(object $chunks)
    {
        $aResponse = [];

            foreach ($chunks as $chunk)
            {
               foreach($chunk as $row)
               {
                   
                   Product::updateOrCreate( 
                       
                    [ 
                        'title' => $row['title']
                    ], 
                    [
                        'service_id' => $row['service_id'],
                        'original_price' =>  $row['original_price'], 
                        'max'  => $row['max'],
                        'min' =>  $row['min'],
                        'category_name' => $row['category_name'],
                        'service_id' => $row['service_id'],
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
    
    
    
    
    public function createUser($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);
            
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $data = $request->only(['name', 'email', 'password']);
        
        
        
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->is_admin = 0;

        
        
        return $user;
    }
    
    
    public function createOrder($sessionCart, $user_id)
    {
        // CREATE ORDER ON INSTANT FANS API
        
        foreach($sessionCart as $itemCart)
        {
            
            foreach($itemCart as $orderData)
            {
                
                $item = $orderData["item"];
                $res = $this->InstantFans->addOrder($item);
                
             
                $res = json_decode($res->getBody(), true);
                dump($res);
                $order = Order::create([
                    'product_id' => $item["id"],
                    'order_api_id' => $res->id,
                    'user_id' => $user_id,
                    'quantity' => $orderData["qty"],
                    'link' => $item["link"]
                ]);
                
                return response()->json( [$order, $res],200);
            }
            
        }
        
        
        
        
        
            
        return $order;    
    }
    
}