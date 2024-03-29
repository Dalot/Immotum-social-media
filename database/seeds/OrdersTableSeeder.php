<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $products = DB::table('products')->limit(5)->get();
        
        foreach ( $products as $product ) {
          # First fetch category Id

          $product_title        = $product->title;
          $product_id     = $product->id;
          $product_user_id    = rand(1, 2);
        
    
          DB::table( 'orders' )->insert( [
            'product_id'          => $product_id,
            'user_id'          => $product_user_id,
            'order_api_id' => rand(0,4353),
            'quantity'    => rand(0, 100),
            'created_at'     => Carbon::now(),
          ] );
    
        }
    }
}
