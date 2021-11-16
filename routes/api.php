<?php

use BinanceApi\Models\Ticker;
use Illuminate\Support\Facades\Route;

Route::get('tickers', function () {

    // Get BTC data.
    $btc = Ticker::firstWhere('symbol', 'BTCUSDT');

    if ($btc) {
        $btc = $btc->toArray();

        return [
        'btc' => $btc,
        //'others' => $others
        ];
    }
});
