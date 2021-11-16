<?php

namespace BinanceApi\Observers;

use BinanceApi\Models\Ticker;
use Illuminate\Support\Str;

class TickerObserver
{
    /**
     * Handle the Ticker "created" event.
     *
     * @param  \App\Models\BinanceApi\Models\Ticker  $ticker
     * @return void
     */
    public function saving(Ticker $ticker)
    {
        $ticker->previous = $ticker->getOriginal('close');
        if (is_null($ticker->idx)) {
            $ticker->idx = 1;
        } else {
            $ticker->increment('idx');
        }

        // Each time is aprox 1 second.
    }

    /**
     * Handle the Ticker "created" event.
     *
     * @param  \App\Models\BinanceApi\Models\Ticker  $ticker
     * @return void
     */
    public function created(Ticker $ticker)
    {
        //
    }

    /**
     * Handle the Ticker "updated" event.
     *
     * @param  \App\Models\BinanceApi\Models\Ticker  $ticker
     * @return void
     */
    public function updated(Ticker $ticker)
    {
        //
    }

    /**
     * Handle the Ticker "deleted" event.
     *
     * @param  \App\Models\BinanceApi\Models\Ticker  $ticker
     * @return void
     */
    public function deleted(Ticker $ticker)
    {
        //
    }

    /**
     * Handle the Ticker "restored" event.
     *
     * @param  \App\Models\BinanceApi\Models\Ticker  $ticker
     * @return void
     */
    public function restored(Ticker $ticker)
    {
        //
    }

    /**
     * Handle the Ticker "force deleted" event.
     *
     * @param  \App\Models\BinanceApi\Models\Ticker  $ticker
     * @return void
     */
    public function forceDeleted(Ticker $ticker)
    {
        //
    }

    private function rTrimDecimals($value)
    {
        $value = rtrim($value, '0');

        if (Str::of($value)->endsWith('.')) {
            $value = $value . '0';
        };

        return $value;
    }
}
