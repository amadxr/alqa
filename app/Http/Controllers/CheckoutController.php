<?php

namespace App\Http\Controllers;

use App\Artwork;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $randomItemsIds = Artwork::all()->random(rand(1, 5))->pluck('id');
        session(['wishlist.items' => $randomItemsIds]);
        $wishlistItems = Artwork::whereIn(
            'id',
            session('wishlist.items')
        )->get();

        return view('billing.checkout', compact('wishlistItems'));
    }

    public function store()
    {
        dd(request()->all());
    }
}
