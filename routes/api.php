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

//Route::apiResource('v1/authors', 'AuthorController', ['only' => ['index']]);
// Route::group(['middleware' => 'auth:api'], function () {
//     Route::apiResource('authors', 'AuthorController', ['only' => ['index']]);
// });

Route::group(['prefix' => 'v1'], function () {
    Route::get('/authors/{author}', 'AuthorController@show')->name('author.show');
    Route::get('/authors', 'AuthorController@index')->name('author.index');
    Route::get('/quotes', 'QuoteController@index')->name('quote.index');
    Route::get('/quotes/random', 'QuoteController@random')->name('quote.random');
    Route::get('/quotes/{quote}', 'QuoteController@show')->name('quote.show');
    Route::post('/vote', 'VoteController@store')->name('vote.store');
});

