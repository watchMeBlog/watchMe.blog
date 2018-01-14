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

<<<<<<< HEAD
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('admin', 'AdminController');

Route::get('/','ReviewController@index');
Route::get('/home',['as' => 'home', 'uses' => 'ReviewController@index']);

//Route::controller([
// 'auth' => 'Auth\AuthController',
// 'password' => 'Auth\PasswordController',
//]);

// ISPRAVITJ NE RABOTAET
//Route::resource('auth', 'Auth\LoginController');
//Route::resource('auth', 'Auth\RegisterController');
Auth::routes();


// check for logged in user
Route::group(['middleware' => ['auth']], function()
{
 // show new review form
 Route::get('new-review','ReviewController@create');
 // save new review
 Route::post('new-review','ReviewController@store');
 // edit post form
 Route::get('edit/{slug}','ReviewController@edit');
 // update review
 Route::post('update','ReviewController@update');
 // delete review
 Route::get('delete/{id}','ReviewController@destroy');
 // display user's all reviews
 Route::get('my-all-reviews','UserController@user_reviews_all');
 // display user's drafts
 Route::get('my-drafts','UserController@user_reviews_draft');
 // add comment
 Route::post('comment/add','CommentController@store');
 // delete comment
 Route::post('comment/delete/{id}','CommentController@distroy');
});
//users profile
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// display list of reviews
Route::get('user/{id}/reviews','UserController@user_reviews')->where('id', '[0-9]+');
// display single review
Route::get('/{slug}',['as' => 'review', 'uses' => 'ReviewController@show'])->where('slug', '[A-Za-z0-9-_]+');
=======
Route::get('/', function () {
    return view('welcome');
});
>>>>>>> 08a55450e173585e40593a58e731a854be991121
