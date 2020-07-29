<?php

namespace App\Http\Controllers;

use App\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'culqi_email' => 'required',
            'culqi_token' => 'required',
        ]);
        $artworks = Artwork::whereIn(
            'id',
            session()->pull('wishlist.items')
        )->get();

        $response = Http::withToken(config('billing.culqi.private_key'))
            ->post(
                'https://api.culqi.com/v2/charges',
                [
                    'amount' => $artworks->sum('price_in_cents'),
                    'currency_code' => 'USD',
                    'email' => $validatedData['culqi_email'],
                    'source_id' => $validatedData['culqi_token'],
                ]
            );

        if ($response->successful()) {
            return redirect('checkout/thanks');
        }
        // TODO: Add error handling
    }
}
