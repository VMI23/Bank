<?php

declare(strict_types=1);

namespace App\Repositories\CryptoCurrencies;

use App\Models\CryptoCurrency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use stdClass;

class CryptoCurrencyJsonRepository implements CryptoCurrencyRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://pro-api.coinmarketcap.com/v1/',
            'headers' => [
                'X-CMC_PRO_API_KEY' => $_ENV['API_KEY'],
                'Accept' => 'application/json',
            ],

        ]);
    }

    public function all()
    {
        $cacheKey = 'crypto-currencies';
        $expirationTime = 60; // Example expiration time of 60 minutes

        return Cache::remember($cacheKey, $expirationTime, function () {
            // This callback will be executed if the data is not found in the cache

            $cryptoCollection = [];

            $response = $this->client->request('GET', 'cryptocurrency/listings/latest', [
                'query' => [
                    'limit' => 100,
                ],
            ]);

            $currencies = json_decode($response->getBody()->getContents());

            foreach ($currencies->data as $currency) {
                $cryptoCollection[] = $this->buildModel($currency);
            }

            return $cryptoCollection;
        });
    }


    public function buildModel(stdClass $currency): CryptoCurrency
    {
        return new CryptoCurrency(
            $currency->id,
            $currency->name,
            $currency->symbol,
            $currency->quote->USD->price,
            $currency->quote->USD->percent_change_24h
        );
    }


    public function getBySymbol(string $symbol): CryptoCurrency
    {
        $response = $this->client->request('GET', 'cryptocurrency/quotes/latest', [
            'query' => [
                'symbol' => $symbol,
            ],
        ]);

        $currency = json_decode($response->getBody()->getContents());

        return $this->buildModel($currency->data->{$symbol});

    }


}
