<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentConfirmBuyRequest;
use App\Http\Requests\InvestmentConfirmSellRequest;
use App\Http\Requests\InvestmentStoreRequest;
use App\Models\InvestmentAccount;
use App\Services\Currencies\CryptoCurrencies\CryptoCurrenciesService;
use App\Services\Currencies\CryptoCurrencies\Show\ShowCryptoCurrencyRequest;
use App\Services\Currencies\CryptoCurrencies\Show\ShowCryptoCurrencyService;
use App\Services\Investments\Buy\BuyInvestmentRequest;
use App\Services\Investments\Buy\BuyInvestmentService;
use App\Services\Investments\Sell\SellInvestmentRequest;
use App\Services\Investments\Sell\SellInvestmentService;
use Illuminate\Support\Facades\Redirect;

class InvestmentAccountController extends Controller
{
    private CryptoCurrenciesService $cryptoCurrenciesService;
    private BuyInvestmentService $buyInvestmentService;
    private SellInvestmentService $sellInvestmentService;
    private ShowCryptoCurrencyService $showCryptoCurrencyService;

    public function __construct(
        CryptoCurrenciesService $cryptoCurrenciesService,
        BuyInvestmentService $buyInvestmentService,
        SellInvestmentService $sellInvestmentService,
        ShowCryptoCurrencyService $showCryptoCurrencyService
    ) {
        $this->cryptoCurrenciesService = $cryptoCurrenciesService;
        $this->buyInvestmentService = $buyInvestmentService;
        $this->sellInvestmentService = $sellInvestmentService;
        $this->showCryptoCurrencyService = $showCryptoCurrencyService;
    }

    public function index()
    {
        $accounts = auth()->user()->investmentAccount()->get() ;
        $symbols = $this->cryptoCurrenciesService->getSymbols();
        $holdings = auth()->user()->investmentAccount->holdings ?? null;
        $priceChanges = $this->cryptoCurrenciesService->getPriceChanges();
        $currentPrices = $this->cryptoCurrenciesService->getPrices();

        return view('investment.accounts', compact('symbols',
            'accounts', 'holdings', 'priceChanges', 'currentPrices'));
    }

    public function store(InvestmentStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        InvestmentAccount::create($validated);

        return Redirect::route('investments')
            ->with('success', 'Investment account created successfully');
    }

    public function create()
    {
        return view('investment.create');
    }

    public function confirmBuyView()
    {
        $symbol = request()->input('symbol');
        $cryptoPrice = $this->getCryptoCurrencyPrice($symbol);
        $currency = $this->getUserInvestmentAccountCurrency();

        return view('investment.confirm-buy', compact('symbol', 'cryptoPrice', 'currency'));
    }

    private function getCryptoCurrencyPrice(string $symbol)
    {
        return round($this->showCryptoCurrencyService
            ->execute(new ShowCryptoCurrencyRequest($symbol))
            ->getCrypto()
            ->getPrice(),8);
    }

    private function getUserInvestmentAccountCurrency()
    {
        return auth()->user()->investmentAccount->currency;
    }

    public function confirmBuy(InvestmentConfirmBuyRequest $request)
    {
        $validated = $request->validated();
        $price = round($validated['price'], 2);
        $symbol = $validated['symbol'];
        $amount = $validated['amount'];
        $investment = $validated['investment'];

        $this->buyInvestmentService->execute(new BuyInvestmentRequest($symbol, $amount, $investment, $price));

        return Redirect::route('investments')
            ->with('success', "You just bought {$amount} {$symbol} for {$price}");
    }

    public function confirmSellView()
    {
        $symbol = request()->input('symbol');
        $cryptoPrice = $this->getCryptoCurrencyPrice($symbol);
        $currency = $this->getUserInvestmentAccountCurrency();

        return view('investment.confirm-sell', compact('symbol', 'cryptoPrice', 'currency'));
    }

    public function confirmSell(InvestmentConfirmSellRequest $request)
    {
        $validated = $request->validated();
        $symbol = $validated['symbol'];
        $amount = $validated['amount'];
        $price = $validated['price'];

        $this->sellInvestmentService->execute(new SellInvestmentRequest($symbol, $amount, $price));

        return Redirect::route('investments')
            ->with('success', "You just sold {$amount} {$symbol} for {$price}");
    }
}
