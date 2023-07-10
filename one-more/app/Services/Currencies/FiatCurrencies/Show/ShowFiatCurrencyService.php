<?php

declare(strict_types=1);

namespace App\Services\Currencies\FiatCurrencies\Show;

use App\Repositories\FiatCurrencies\CurrencyRepository;

class ShowFiatCurrencyService
{
    private CurrencyRepository $repository;

    public function __construct(
        CurrencyRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function execute(ShowFiatCurrencyRequest $request): ShowFiatCurrencyResponse
    {
        $senderCurrency = $request->getSenderCurrency();
        $receiverCurrency = $request->getReceiverCurrency();
        $amount = $request->getAmount();

        if ($senderCurrency === $receiverCurrency) {
            return new ShowFiatCurrencyResponse($amount,1);
        }

        $senderToEuro = $this->convertToEur($senderCurrency, $amount);
        $convertedAmount = $this->convertFromEur($receiverCurrency, $senderToEuro);
        $finalRate  = $convertedAmount/$amount;


        return new ShowFiatCurrencyResponse($convertedAmount, $finalRate);
    }

    protected function convertToEur(string $currency, float $amount): float
    {
        $rate = $this->repository->getRateByCurrency($currency)->getRate();

        return $amount / $rate;
    }

    protected function convertFromEur(string $currency, float $amount): float
    {
        $rate = $this->repository->getRateByCurrency($currency)->getRate();
        return $amount * $rate;
    }
}
