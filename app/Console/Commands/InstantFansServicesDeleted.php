<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\InstantFansServiceDeletedMail;
use App\Product;


class InstantFansServicesDeleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instant-fans:services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if there is any instant-fans service that was deleted and it is still on our database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $OurTotalServices = \DB::table('products')
                  ->count();
                  
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
        $TheirTotalServices = sizeof( $results );
        
        if($OurTotalServices !== $TheirTotalServices)
        {
            $results =  json_decode( $res->getBody(), true );
            $oldProducts = [];
            $myProducts = Product::all();
            
            
            foreach($myProducts as $prod)
            {
                
                if ( in_array($prod->title , array_column($results, 'name')) ) 
                {
                    // Product Found in the API
                }
                else
                {
                    $oldProducts[] = Product::where('title', $prod->title )->first();
                }
            }
            
            
            \Mail::to('example@gmail.com')->send(new InstantFansServiceDeletedMail($OurTotalServices, $TheirTotalServices, $oldProducts));
        }
    }
}
