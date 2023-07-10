<?php

declare(strict_types=1);

namespace App\Services\Currencies\CryptoCurrencies\Show;

use App\Repositories\CryptoCurrencies\CryptoCurrencyRepository;

class ShowCryptoCurrencyService
{
    private CryptoCurrencyRepository $cryptoCurrencyRepository;
    public function __construct(CryptoCurrencyRepository $cryptoCurrencyRepository)
    {
        $this->cryptoCurrencyRepository = $cryptoCurrencyRepository;
    }

    public function execute(ShowCryptoCurrencyRequest $request): ShowCryptoCurrencyResponse
    {
        $response = $this->cryptoCurrencyRepository->getBySymbol($request->getSymbol());
        return new ShowCryptoCurrencyResponse($response);

    }

}
