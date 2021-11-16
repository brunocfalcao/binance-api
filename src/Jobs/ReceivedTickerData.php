<?php

namespace BinanceApi\Jobs;

use BinanceApi\Models\Ticker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ReceivedTickerData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticker;
    public $tickerBtc;
    public $now;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $ticker, array $tickerBtc, string $now)
    {
        $this->ticker = $ticker;
        $this->tickerBtc = $tickerBtc;
        $this->now = $now;
    }

    public function handle()
    {
        if (!Str::of($this->ticker['symbol'])->endsWith('USDT')) {
            return;
        }

        /*
        // Last 24 hours average price will serve as a price baseline.
        $average = ($this->ticker['open'] + $this->ticker['close']) / 2;
        $averageBtc = ($this->tickerBtc['open'] + $this->tickerBtc['close']) / 2;

        $relVariation = $this->percentage($average, $this->ticker['close']);
        $btcVariation = $this->percentage($averageBtc, $this->tickerBtc['close']);
        $relBtcVariation = $relVariation - $btcVariation;
        */

        Ticker::updateOrCreate(
            ['symbol' => $this->ticker['symbol']],
            [
                'close' => $this->ticker['close'],
                'open_24h' => $this->ticker['open'],
                //'average' => $average,
                //'rel_variation' => $relVariation,
                //'rel_btc_variation' => $relBtcVariation
            ]
        );
    }

    private function percentage($hundred, $current, $decimals = 3)
    {
        $ratio = $current * 100 / $hundred;

        return $ratio < 100 ?
        number_format((100 - $ratio) * -1, $decimals) :
        number_format($ratio - 100, $decimals);
    }
}
