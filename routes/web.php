<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
    Get Projects - index
    Get projects/create - create
    Get projects/1 - show
    Get projects/1/edit - edit
    
    Post /projects - store
    
    Patch /projects/1 - update
    
    Delete /projects/1 - destroy
    
*/

use App\Notifications\SubscriptionRenewalFailed;

Route::get("/", 'PagesController@home');

Route::get("homepage", 'PagesController@homepage');

Route::get("/notification", function(){
    $user = App\User::first();
    
    $user->notify(new SubscriptionRenewalFailed);
    
    return "done";
});


Route::resource('projects', 'ProjectsController');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');
Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('products', 'ProductsController@index');


