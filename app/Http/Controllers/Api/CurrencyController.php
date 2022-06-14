<?php

namespace App\Http\Controllers\Api;
use App\Models\Currency;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    /**
     * List of all currencies
     */
    public function all()
    {
        $currencies = Currency::all();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'currencies' => $currencies,
        ]);
    }

}