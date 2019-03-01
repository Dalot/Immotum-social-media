<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\API\InstantFans;
use Validator;
use App\Http\Resources\InstantFansResource;
use App\Repositories\InstantFansRepository;
use App\Product;

class InstantFansController extends Controller
{
    public function __construct(InstantFans $InstantFans)
    {
        $this->InstantFans = $InstantFans;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = Product::select('category_name')->distinct()->get();
        
        
        return response()->json( [Product::all(), $categories],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(InstantFansRepository $InstantFansRepository)
    {

        $myClient = new Client();
        
        // Scrape instant-fans website to fetch all the descriptions.
        $scrapeData = $myClient->request('POST', 'http://node.dalot.xyz:8081/scrape'); 
        $scrapeData = json_decode( $scrapeData->getBody(), true ) ;
        
        // Get all the services available from the Instant Fans API 
        $results = $this->InstantFans->getServices();
            
        // Validate the data received from the Instant Fans API
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
           
                
            $prod = $validator->getData();
            
            $desc = (isset( $scrapeData[$key]["description"]) ? $scrapeData[$key]["description"] : "" );
            $prod["description"] = $desc;
            
            // Convert the API data to our model and add it to $final_results
            $prod = InstantFansResource::make($prod)->resolve();
            $final_results[] = $prod;
              
               
            
        }
        
        // Divide it up in chunks
        $chunks = collect($final_results)->chunk(100);

        // Update or Create each product received by the API
        $all_results = $InstantFansRepository->updateOrCreate($chunks); 
            
        return response()->json($all_results, 200);
 
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
