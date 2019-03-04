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
    Route::get('/stripe', 'StripeController@index');
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
        
        Route::post('/stripe', 'StripeController@charge')->middleware("web");
        Route::post('/charge-success', 'StripeController@success')->middleware('verified');


        // Route::patch('orders/{order}/deliver','OrderController@deliverOrder');
        Route::resource('/users', 'UserController')->except('index');
        Route::resource('/orders', 'OrderController')->except('login, register');
        
        /*
            == GUEST ==
            login -> Login user and create a token to associate to the user DOCUMENTED
            register -> Create a new User DOCUMENTED
            
            == User ==
            show -> show this user profile  with their orders DOCUMENTED
            edit -> User page to edit profile (FRONT END)
            destroy -> option do delete his account DOCUMENTED
            update -> Update this profile info for this user DOCUMENTED
            
            == ADMIN ==
            index -> Show all users with their orders
            create -> An admin page to create a new User
            
            Non-existent
            store -> ??
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