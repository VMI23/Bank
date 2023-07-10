<?php

namespace App\Providers;

use App\Repositories\CryptoCurrencies\CryptoCurrencyJsonRepository;
use App\Repositories\CryptoCurrencies\CryptoCurrencyRepository;
use App\Repositories\FiatCurrencies\CurrencyRepository;
use App\Repositories\FiatCurrencies\FiatCurrencyXmlRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CurrencyRepository::class, FiatCurrencyXmlRepository::class);
        $this->app->bind(CryptoCurrencyRepository::class, CryptoCurrencyJsonRepository::class);

    }

    public function boot()
    {
        //
    }
}
