<?php

use Illuminate\Support\Facades\Route;
use App\Artwork;

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
    $randomItemsIds = Artwork::all()->random(rand(1, 5))->pluck('id');
    session(['cart.items' => $randomItemsIds]);
    return view('welcome');
});

Route::get('/cart', 'CheckoutController@index');
Route::post('/checkout', 'CheckoutController@store');
Route::get('/checkout/thanks', 'ThanksCheckoutController');

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
