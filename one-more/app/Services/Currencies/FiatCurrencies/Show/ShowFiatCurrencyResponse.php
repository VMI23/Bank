<?php

declare(strict_types=1);

namespace App\Services\Currencies\FiatCurrencies\Show;

class ShowFiatCurrencyResponse
{
    private float $amountInCurrency;
    private float $rate;

    public function __construct(float $amountInCurrency, float $rate)
    {
        $this->amountInCurrency = $amountInCurrency;
        $this->rate = $rate;
    }

    public function getAmountInCurrency(): float
    {
        return $this->amountInCurrency;
    }


    public function getRate(): float
    {
        return $this->rate;
    }



}
