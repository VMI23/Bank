<?php

declare(strict_types=1);

namespace App\Services\Investments\Sell;

class SellInvestmentRequest
{
    private string $symbol;
    private float $amount;
    private float $price;

    public function __construct(string $symbol, float $amount, float $price)
    {
        $this->symbol = $symbol;
        $this->amount = $amount;
        $this->price = $price;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getInvestment(): float
    {
        return $this->price * $this->amount;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

}
