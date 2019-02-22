<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Validator;
use App\Http\Resources\InstantFansResource;
use App\Product;

class InstantFansController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        dd("stop");
        
         $client = new Client();
            $res = $client->request('POST', 'https://instant-fans.com/api/v2',
            [
                'query' =>
                [
                    'key' => env('INSTANT_FANS_API_KEY'),
                    'action' => 'services'
                ]
            ]);  
        $myClient = new Client();
        $scrapeData = $myClient->request('POST', 'http://node.dalot.xyz:8081/scrape'); 
        $scrapeData = json_decode( $scrapeData->getBody(), true ) ;
            
            
            $results = json_decode( $res->getBody(), true );
            
            
            foreach($results as $key=>$result)
            {
                $validator = Validator::make($result, [
                    'name' => ['required','min:3', 'max:255'],
                    'category' => ['required','min:3', 'max:255'],
                    'min' => ['required','min:1', 'max:255'],
                    'max' => ['required','min:1'],
                    'rate' => ['required'],
                    'service' => ['required'],
                    'type' => ['required']
                ]);
                
                if ( $validator->fails() ) 
                {
                    return $validator->errors();
                }
                else
                {
                    
                    $prod = $validator->getData();
                    $desc = (isset( $scrapeData[$key]["description"]) ? $scrapeData[$key]["description"] : $prod["type"] );
                    $prod["description"] = $desc;
                    
                    $prod = InstantFansResource::make($prod)->resolve();
                    $final_results[] = $prod;
                  
                   ;
                }
            }
            
            
            $final_collection = collect($final_results);
            $chunks = $final_collection->chunk(100);
            $aResponse = [];

            foreach ($chunks as $chunk)
            {
               foreach($chunk as $row)
               {
                   Product::updateOrCreate( ['title' => $row['title'] ], 
                    [
                        'original_price' => $row['original_price'], 
                        'max'  => $row['max'],
                        'min' =>  $row['min'],
                        'category_name' => $row['category_name'],
                        'description' => $row['description']
                    ]);
                    
                    $aResponse[] = [
                        'status' => (bool) $row,
                        'data'   => $row,
                        'message' => $row ? 'Product Created!' : 'Error Creating Product'
                    ];
                  
               }
            }
            
        return response()->json($aResponse, 200);
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product,200); 
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
