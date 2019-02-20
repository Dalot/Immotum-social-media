<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Http\Middleware\Admin;
use Validator;

use App\Http\Resources\InstantFansResource;


class ProductsAdminController extends Controller
{
   
    
    public function __construct(Product $product)
    {
        $this->middleware('auth');
        
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    
    
            
  
     
     
    public function index()
    {
        ;
        // If the user is authenticated and is an admin, fetch all the available services.
        if ( Auth::check() ) {

            
           
            
        }
        else
        {
            abort(403);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $result = json_decode( $res->getBody(), true );
            
            $validator = Validator::make($result[0], [
                'name' => ['required','min:3', 'max:255'],
                'category' => ['required','min:3', 'max:255'],
                'min' => ['required','min:1', 'max:255'],
                'max' => ['required','min:1', 'max:1000000'],
                'rate' => ['required', 'max: 1000000']
            ]);
          
            if ( $validator->fails() ) {
                return $validator->errors();
                            
            }
            else
            {
                
                $prod = $validator->getData();

           
            // create record and pass in only fields that are fillable
            // $this->model->create($result_products);
             if (!$request->ajax()) {
                
                    
                   $prod = InstantFansResource::make($prod)->resolve();
                   
                   Product::firstOrCreate($prod);
                
                 return 'done'; 
             }
            }
            
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
