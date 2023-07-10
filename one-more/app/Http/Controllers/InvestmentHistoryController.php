<?php

namespace App\Http\Controllers;

use App\Services\Investments\InvestmentHistoryService;

class InvestmentHistoryController extends Controller
{

    private $investmentHistoryService;

    public function __construct(InvestmentHistoryService $investmentHistoryService)
    {
        $this->investmentHistoryService = $investmentHistoryService;
    }

    public function index()
    {
        $symbol = request()->route('symbol');
        $user = auth()->user();

        $histories = $this->investmentHistoryService->getInvestmentHistory($user, $symbol);


        return view('investment.history.investment-history', compact('histories', 'symbol'));
    }

}
