<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Session;
use App\User;
use App\Repositories\InstantFansRepository;

class StripeController extends Controller
{
    public function __construct()
    {
       
    }
    
    
    function index(Request $request)
    {
        $cartSession = $request->session()->get('cart');
        
        return response()->json($cartSession, 200);
            
    }
    
     function charge(Request $request, InstantFansRepository $InstantFansRepository)
    {
        $amount = $request->session()->get('cart')->totalPrice * 100;
        
        $user = $InstantFansRepository->createUser($request);
       
        $token = $user->createToken('ImmotumInstantFans')->accessToken;
        

        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        
            $customer = Customer::create(array(
                'email' => $user["email"],
                'source' => $request->stripeToken
            ));
        
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $amount,
                'currency' => 'usd'
            ));
        
            return response()->json($customer, 200);;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    function success()
    {
        return view('success');
    }
}
