<?php

use Illuminate\Http\Request;
use App\Http\Resources\Author as AuthorResource;
use App\Author;
use App\Http\Resources\AuthorCollection;

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

// Route::get('/v1/authors/{id}', function ($id) {
//     return new AuthorResource(Author::find($id));
// });

// Route::get('/v1/authors', function () {
//     return new AuthorCollection(Author::paginate());
// });

Route::get('/v1/authors/{author}', 'AuthorController@show')->name('author.show');

Route::get('/v1/authors', 'AuthorController@index')->name('author.index');
