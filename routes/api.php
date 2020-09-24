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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('films', 'FilmController@index');
Route::group(['prefix' => 'film'], function () {
    Route::post('add', 'FilmController@add');
    Route::get('edit/{slug}', 'FilmController@edit');
    Route::post('update/{id}', 'FilmController@update');
    Route::delete('delete/{id}', 'FilmController@delete');

    Route::post('comment', 'FilmController@comment');

});


Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'jwt.verify'], function(){
    Route::get('auth/user', 'AuthController@user');
});
Route::group(['middleware' => 'jwt.verify'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');
});
Route::group(['middleware' => 'jwt.verify'], function(){
    Route::post('auth/logout', 'AuthController@logout');
});