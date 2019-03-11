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
Route::get('/products', 'InstantFansController@index')->name('products.index');
Route::get('/products/{product}', 'InstantFansController@show');



// ========= Needs web middleware to set session ============== //
Route::group(['middleware' => ['web']], function () { 
    Route::resource('/cart', 'CartController');
});





// ====================== AUTHENTICATION ====================== //
Route::post('login', 'UserController@login')->name('users.login');
Route::post('register', 'UserController@register')->name('users.register');




// ====================== MUST BE AUTHENTICATED ROUTES ====================== //


Route::group(['middleware' => ['auth:api','json.response']], function(){
    
    Route::group(['middleware' => ['admin']], function() {
        
        Route::get('/users','UserController@index');
        
        Route::post('/products/fetch', 'InstantFansController@fetch')->name('products.fetch');
        
        Route::resource('/products', 'InstantFansController')->except(['index','show']);
        
    });
    

        Route::get('users/{user}/orders','UserController@showOrders');
        
        Route::post('/stripe', 'StripeController@charge')->middleware("web"); // needs web middleware to use session
        Route::post('/charge-success', 'StripeController@success')->middleware('verified');


        // Route::patch('orders/{order}/deliver','OrderController@deliverOrder');
        Route::resource('/users', 'UserController')->except('index');
        Route::resource('/orders', 'OrderController');
        
        /*
           
            
            Non-existent
            users -> store -> ??
            users -> create
        */
        
        
       
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