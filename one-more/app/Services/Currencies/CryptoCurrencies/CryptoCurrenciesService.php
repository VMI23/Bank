<?php

declare(strict_types=1);

namespace App\Services\Currencies\CryptoCurrencies;

use App\Repositories\CryptoCurrencies\CryptoCurrencyRepository;

class CryptoCurrenciesService
{
    private CryptoCurrencyRepository $cryptoCurrenciesRepository;

    public function __construct(CryptoCurrencyRepository $cryptoCurrenciesRepository)
    {
        $this->cryptoCurrenciesRepository = $cryptoCurrenciesRepository;
    }

    public function execute(): array
    {
        return $this->cryptoCurrenciesRepository->all();
    }

    public function getSymbols(): array
    {
        $response = $this->cryptoCurrenciesRepository->all();
        $symbols = [];
        foreach ($response as $cryptoCurrency) {
            $symbols[] = $cryptoCurrency->getSymbol();
        }
        return $symbols;
    }

    public function getPriceChanges(): array
    {
        $response = $this->cryptoCurrenciesRepository->all();
        $priceChanges = [];
           foreach ($response as $cryptoCurrency) {
                $priceChanges[$cryptoCurrency->getSymbol()] = round($cryptoCurrency->getChange24h(),2);
            }

        return $priceChanges;
    }

    public function getPrices(): array
    {
        $response = $this->cryptoCurrenciesRepository->all();
        $prices = [];
           foreach ($response as $cryptoCurrency) {
                $prices[$cryptoCurrency->getSymbol()] = round($cryptoCurrency->getPrice(),2);
            }

        return $prices;
    }


}
