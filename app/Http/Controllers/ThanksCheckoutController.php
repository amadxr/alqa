<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanksCheckoutController extends Controller
{
    public function __invoke()
    {
        return view('billing.thanks');
    }
}
