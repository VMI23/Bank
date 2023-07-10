<?php
declare(strict_types=1);

namespace App\Services\Investments\Buy;

class BuyInvestmentRequest
{
    private string $symbol;
    private float $amount;
    private float $investment;

    private float $price;

    public function __construct(string $symbol, float $amount, float $investment, float $price)
    {
        $this->symbol = $symbol;
        $this->amount = $amount;
        $this->investment = $investment;
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
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
        return $this->investment;
    }

}
