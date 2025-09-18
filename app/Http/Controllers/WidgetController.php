<?php

namespace App\Http\Controllers;

use App\Models\Donation;

class WidgetController extends Controller
{
    public function __invoke()
    {
        return view('total-donations', [
            'total' => number_format(Donation::all()
                                             ->sum('amount'), 2) . '€',
        ]);
    }
}
