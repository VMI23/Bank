<?php

//declare(strict_types=1);

namespace App\Repositories\FiatCurrencies;

use App\Models\FiatCurrency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class FiatCurrencyXmlRepository implements CurrencyRepository
{

    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getCurrencyAllRates(): array
    {
        $cacheKey = 'currency-rates'.now()->format('Y-m-d');

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        return Cache::remember($cacheKey, 1, function () {
            $response = $this->client->request(
                'GET',
                'https://www.bank.lv/vk/ecb.xml'
            );

            $records = simplexml_load_string($response->getBody()->getContents());
            $rates = $records->Currencies->Currency;

            $ratesArray = [];

            foreach ($rates as $rate) {
                $ratesArray[(string)$rate->ID] = $this->buildModel((string)$rate->ID, (float)$rate->Rate);
                $ratesArray['EUR'] = $this->buildModel('EUR', 1);
            }

            return $ratesArray;
        });
    }



    protected function buildModel(string $currency, float $rate): FiatCurrency
    {
        return new FiatCurrency($currency, $rate);
    }

    public function getRateByCurrency(string $currency) : FiatCurrency
    {
        $rates = $this->getCurrencyAllRates();

        return $rates[$currency];
    }


}
