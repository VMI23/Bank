<?php

declare(strict_types=1);

namespace App\Services\Currencies\FiatCurrencies\Show;

class ShowFiatCurrencyRequest
{
    private string $senderCurrency;
    private string $receiverCurrency;
    private float $amount;

    public function __construct(string $senderCurrency, string $receiverCurrency, float $amount)
    {
        $this->senderCurrency = $senderCurrency;
        $this->receiverCurrency = $receiverCurrency;
        $this->amount = $amount;
    }

    public function getSenderCurrency(): string
    {
        return $this->senderCurrency;
    }

    public function getReceiverCurrency(): string
    {
        return $this->receiverCurrency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

}
