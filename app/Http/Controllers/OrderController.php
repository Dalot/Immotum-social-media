<?php

namespace App\Http\Controllers;

use App\Order;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use Auth;
use App\Repositories\InstantFansRepository;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $data = Order::where( 'user_id', $user->id )->get();
        
        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created order in our database AND in Instant-Fans.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, InstantFansRepository $InstantFansRepository, User $user)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $user = Auth::user();
        $orderOwnerId = $order->user_id;
  
        if ( $orderOwnerId === $user->id)
        {
            return response()->json($order,200);
        }
        else
        {
            abort(403, "Unauthorised");
        }
        
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $user = Auth::user();
        $orderOwnerId = $order->user_id;
  
        if ( $orderOwnerId === $user->id)
        {
            $status = $order->update(
                $request->only(['quantity'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Updated!' : 'Error Updating Order'
            ]);
        }
        else
        {
            abort(403, "Unauthorised");
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $user = Auth::user();
        $orderOwnerId = $order->user_id;
  
        if ( $orderOwnerId === $user->id)
        {
            $status = $order->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Deleted!' : 'Error Deleting Order'
            ]);
        }
        else
        {
            abort(403, "Unauthorised");
        }
        
    }
}
