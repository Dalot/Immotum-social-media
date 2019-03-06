<?php

namespace App;


class Cart 
{
    public $items = null;
    public $totalQty;
    public $totalPrice;
    public $destiny_url;
    
    public function __construct($oldCart)
    {
        if ($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
       
    }
    
    public function add($item, $id, $order_details)
    {
        $item["order_details"] = $order_details;
        
        $storedItem = [
            'qty' => 0, 
            'price' => $item->our_price, 
            'item' => $item,
            
        ];
     
        if($this->items)
        {
            if(array_key_exists($id, $this->items))
            {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->our_price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->our_price;
    }
}
