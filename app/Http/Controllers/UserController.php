<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\API\InstantFans;
use App\User;
use App\Order;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a page with all users with their orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::with(['orders'])->get(), 200);
    }
    
    
    
    
    /**
     * Authenticates a user and generates an access token for that user
     * The createToken method is one of the methods Laravel Passport adds to our user model.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($credentials)) {
            $status = 200;
            $token = Auth::user()->createToken('ImmotumInstantFans')->accessToken;
            
      
            $response = [
                'user' => Auth::user(),
                'token' => $token,
                'token_type' => 'Bearer'
            ];
            
            
            
            
            
            return response()->json($response, $status);
        }

        return response()->json($response, $status);
    }
    
    
    
    /**
     * creates a user account, authenticates it and generates an access token for it.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function register(Request $request)
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
    
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('ImmotumInstantFans')->accessToken,
            ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Gets the details of a user and returns them.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }
    
    
    /**
     * Gets all the orders of a user and returns them.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrders(User $user, InstantFans $InstantFans)
    {
        $orders = $user->orders()->with(['product'])->where('user_id', $user->id )->get();
        $order_api_ids = Order::select('order_api_id')->where('user_id', $user->id)->get()->toArray();
        $arr = [];
        
        foreach($order_api_ids as $id)
        {
            $arr[] = $id["order_api_id"];
        }
        

        $res = $InstantFans->getStatuses($arr);
        
        if(!isset($res))
        {
            foreach($orders as $order)
            {
                $api_id = $order->order_api_id;
               
                Order::where('id', $order->id)->update( ['status', $res[$api_id]->status] );
            }
        }
            
        return response()->json($orders);
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
