<?php

namespace BinanceApi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'close_tick_10p',
        'close_tick_30p',
        'close_tick_60p',
        'close_tick_120p',
        'close_tick_240p',
        'close_tick_480p',
        'close_tick_960p',
        'close_tick_1920p',
    ];

    public function getCloseTick10pAttribute()
    {
        if ($this->close_tick_10 != null && $this->close_tick_10 != 0) {
            return $this->percentage($this->close_tick_10, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    public function getCloseTick30pAttribute()
    {
        if ($this->close_tick_30 != null && $this->close_tick_30 != 0) {
            return $this->percentage($this->close_tick_30, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    public function getCloseTick60pAttribute()
    {
        if ($this->close_tick_60 != null && $this->close_tick_60 != 0) {
            return $this->percentage($this->close_tick_60, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    public function getCloseTick120pAttribute()
    {
        if ($this->close_tick_120 != null && $this->close_tick_120 != 0) {
            return $this->percentage($this->close_tick_120, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    public function getCloseTick240pAttribute()
    {
        if ($this->close_tick_240 != null && $this->close_tick_240 != 0) {
            return $this->percentage($this->close_tick_240, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    public function getCloseTick480pAttribute()
    {
        if ($this->close_tick_480 != null && $this->close_tick_480 != 0) {
            return $this->percentage($this->close_tick_480, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    public function getCloseTick960pAttribute()
    {
        if ($this->close_tick_960 != null && $this->close_tick_960 != 0) {
            return $this->percentage($this->close_tick_960, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    public function getCloseTick1920pAttribute()
    {
        if ($this->close_tick_1920 != null && $this->close_tick_1920 != 0) {
            return $this->percentage($this->close_tick_1920, $this->close, 5);
        } else {
            return 'NA';
        }
    }

    private function percentage($hundred, $current, $decimals = 3)
    {
        $ratio = $current * 100 / $hundred;

        return $ratio < 100 ?
        number_format((100 - $ratio) * -1, $decimals) :
        number_format($ratio - 100, $decimals);
    }
}
