<?php

namespace App\Http\Controllers;

use App\Artwork;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $randomItemsIds = Artwork::all()->random(rand(1, 5))->pluck('id');
        session(['cart.items' => $randomItemsIds]);
        $artworkFilter = $request->get('filter', null);

        $artworkQuery = Artwork::whereHas('artworkType', function ($q) use ($artworkFilter){
            if($artworkFilter) {
                $q->where('slug', $artworkFilter);
            }
        });
        $artworks = $artworkQuery->get();
        return view('welcome')->with('artworks', $artworks);
    }
}
