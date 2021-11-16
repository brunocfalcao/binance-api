<?php

namespace BinanceApi\Commands;

use BinanceApi\API;
use BinanceApi\Jobs\ReceivedTickerData;
use BinanceApi\Models\Ticker;
use BinanceApi\RateLimiter;
use Illuminate\Console\Command;

class GetTickers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'binance-api:get-tickers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets all future tokens last price ticker and triggers store jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api = new RateLimiter(new API(env('BINANCE_API_KEY'), env('BINANCE_API_SECRET')));

        $api->miniTicker(function ($api, $tickers) {

            $tickerBtc = collect($tickers)->firstWhere('symbol', 'BTCUSDT');

            if ($tickerBtc) {
                foreach ($tickers as $ticker) {
                    ReceivedTickerData::dispatch($ticker, $tickerBtc, now());
                }
            }

            $this->info(now());
        });

        return Command::SUCCESS;
    }
}
