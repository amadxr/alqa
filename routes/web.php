<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/checkout', 'CheckoutController@index');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::view('/gallery', 'gallery-settings')->name('gallery-settings');
    Route::view('/artwork', 'artwork-index')->name('artwork-index');
    Route::view('/artwork/create', 'artwork-create')->name('artwork-create');
    Route::get('/artwork/show/{id}', function ($id) {
        return view('artwork-show', ['artworkId' => $id]);
    });
});
