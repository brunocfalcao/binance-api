<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinanceApiSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idx')
                  ->default(0);

            $table->string('symbol');

            $table->decimal('open_24h', 25, 15)
                  ->comment('Previous 24h open fetched price.');

            $table->decimal('close', 25, 15)
                  ->comment('Last (close) fetched price.');

            $table->decimal('previous', 25, 15)
                  ->nullable()
                  ->comment('Previous (previous tick) fetched price.');

            $table->decimal('past_tick_m1', 25, 15)
                  ->nullable()
                  ->comment('Last X ticks fetched price.');

            $table->decimal('past_tick_m5', 25, 15)
                  ->nullable()
                  ->comment('Last X ticks fetched price.');

            $table->decimal('past_tick_m10', 25, 15)
                  ->nullable()
                  ->comment('Last X ticks fetched price.');

            $table->decimal('past_tick_m30', 25, 15)
                  ->nullable()
                  ->comment('Last X ticks fetched price.');

            $table->decimal('past_tick_m60', 25, 15)
                  ->nullable()
                  ->comment('Last X ticks fetched price.');

            $table->timestamps();

            $table->engine = 'MyISAM';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickers');
    }
}
