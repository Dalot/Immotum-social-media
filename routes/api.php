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

// ====================================================== //








// ====================== AUTHENTICATION ====================== //
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

// ============================================================ //

Route::group(['middleware' => ['web']], function(){
    Route::resource('/cart', 'CartController');
});
// ====================== MUST BE AUTHENTICATED ROUTES ====================== //


Route::group(['middleware' => ['auth:api','json.response']], function(){
        Route::get('/fetch', 'InstantFansController@fetch');
        Route::get('/users','UserController@index');
        Route::get('users/{user}','UserController@show');
        Route::get('users/{user}/orders','UserController@showOrders');
        Route::get('/stripe', 'StripeController@index')->middleware('verified');
        
        Route::patch('users/{user}','UserController@update');
        Route::patch('products/{product}/units/add','InstantFansController@updateUnits');
        Route::patch('orders/{order}/deliver','OrderController@deliverOrder');
        
        Route::post('/stripe', 'StripeController@charge');
        Route::post('/charge-success', 'StripeController@success')->middleware('verified');
        
        Route::resource('/orders', 'OrderController');
        Route::resource('/products', 'InstantFansController')->except(['index','show','store']);
        
       
    });
// ========================================================================== //



// ====================== STRIPE ====================== //
Route::get('/stripe', 'StripeController@index')->middleware('verified');
Route::post('/stripe', 'StripeController@charge');
Route::post('/charge-success', 'StripeController@success')->middleware('verified');
// ==================================================== //








// ========================== TESTING ========================== //
Route::get("/notification", function(){
    $user = App\User::first();
    
    $user->notify(new SubscriptionRenewalFailed);
    
    return "done";
});
// ============================================================ //