<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'wallpapers'], function () {
    Route::get('/', 'Api\WallpaperController@show');
    Route::post('/', 'Api\WallpaperController@store');
});

Route::group(['prefix' => 'artworks'], function () {
    Route::get('/', 'Api\ArtworkController@index');
    Route::get('/{id}', 'Api\ArtworkController@show');
    Route::post('/', 'Api\ArtworkController@store');
    Route::put('/', 'Api\ArtworkController@update');
    Route::delete('/{id}', 'Api\ArtworkController@delete');
});
