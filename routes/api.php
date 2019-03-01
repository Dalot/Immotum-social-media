<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// ====================== PRODUCTS ====================== //
Route::get('/products', 'InstantFansController@index');
Route::get('/products/{product}', 'InstantFansController@show');



// ========= Needs web middleware to set session ============== //
Route::group(['middleware' => ['web']], function () { 
    Route::resource('/cart', 'CartController');
    Route::get('/stripe', 'StripeController@index');
});





// ====================== AUTHENTICATION ====================== //
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');




// ====================== MUST BE AUTHENTICATED ROUTES ====================== //


Route::group(['middleware' => ['auth:api','json.response']], function(){
        Route::post('/stripe', 'StripeController@charge')->middleware("web");
        Route::post('/fetch', 'InstantFansController@fetch');
 
        Route::get('/users','UserController@index');
        Route::get('users/{user}','UserController@show');
        Route::get('users/{user}/orders','UserController@showOrders');
        
        
        Route::patch('users/{user}','UserController@update');
        Route::patch('products/{product}/units/add','InstantFansController@updateUnits');
        Route::patch('orders/{order}/deliver','OrderController@deliverOrder');
        
        
        Route::post('/charge-success', 'StripeController@success')->middleware('verified');
        
        Route::resource('/orders', 'OrderController');
        Route::resource('/products', 'InstantFansController')->except(['index','show','store']);
        
       
    });
// ========================================================================== //





// ==================================================== //








// ========================== TESTING ========================== //
Route::get("/notification", function(){
    $user = App\User::first();
    
    $user->notify(new SubscriptionRenewalFailed);
    
    return "done";
});
// ============================================================ //