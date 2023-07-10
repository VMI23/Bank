<?php

declare(strict_types=1);

namespace App\Services\Currencies\CryptoCurrencies\Show;

class ShowCryptoCurrencyRequest
{
    private string $symbol;

    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

}
