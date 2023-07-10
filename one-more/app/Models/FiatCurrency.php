<?php

namespace App\Models;



class FiatCurrency
{

    private string $symbol;
    private float $rate;

    public function __construct(string $symbol, string $rate)
    {
        $this->symbol = $symbol;
        $this->rate = $rate;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

}
