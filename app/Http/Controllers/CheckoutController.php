<?php

namespace App\Http\Controllers;

use App\Artwork;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $wishlistItems = Artwork::all()->random(2);

        return view('billing.checkout', compact('wishlistItems'));
    }
}
