<?php

declare(strict_types=1);

namespace App\Services\Investments\Buy;

use App\Models\Holding;
use App\Models\InvestmentHistory;

class BuyInvestmentService
{
    public function execute(BuyInvestmentRequest $request): void
    {
        $investmentAccount = auth()->user()->investmentAccount;
        $investmentAccount->subtractAndSave($request->getInvestment());

        $holding = Holding::firstOrCreate([
            'symbol' => $request->getSymbol(),
            'investment_account_id' => $investmentAccount->id,
        ]);

        $holding->addAndSave($request->getAmount());
        $holdingId = $holding->id;
        $investmentHistory = InvestmentHistory::create([
            'holding_id' => $holdingId,
            'amount_bought' => $request->getAmount(),
            'price_bought' => $request->getPrice(),
            'purchase_date' => now(),
        ]);
    }
}
