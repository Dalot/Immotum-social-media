<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Validator;
use App\Http\Resources\InstantFansResource;
use App\Product;

class InstantFansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
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
            $results = json_decode( $res->getBody(), true );
           
            
            foreach($results as $result)
            {
                $validator = Validator::make($result, [
                    'name' => ['required','min:3', 'max:255'],
                    'category' => ['required','min:3', 'max:255'],
                    'min' => ['required','min:1', 'max:255'],
                    'max' => ['required','min:1'],
                    'rate' => ['required']
                ]);
                if ( $validator->fails() ) {
                    
                    return $validator->errors();
                                
                }
                else
                {
                    
                    $prod = $validator->getData();
                    
                    $prod = InstantFansResource::make($prod)->resolve();
                    $final_results[] = $prod;
                }
            }
            
            $final_collection = collect($final_results);
           
            
            $chunks = $final_collection->chunk(100);
            
            foreach ($chunks as $chunk)
            {
               foreach($chunk as $row)
               {
                   Product::updateOrCreate( ['title' => $row['title'] ], 
                    [
                        'original_price' => $row['original_price'], 
                        'max'  => $row['max'],
                        'min' =>  $row['min'],
                        'category_name' => $row['category_name']
                    ]);
                  
               }
            }
            
            return 'done'; 
            
          
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}