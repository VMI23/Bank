<?php
declare(strict_types=1);

namespace App\Services\Currencies\CryptoCurrencies\Show;

use App\Models\CryptoCurrency;

class ShowCryptoCurrencyResponse
{
    private CryptoCurrency $crypto;

    public function __construct(CryptoCurrency $crypto)
    {
        $this->crypto = $crypto;
    }

    public function getCrypto(): CryptoCurrency
    {
        return $this->crypto;
    }

}
