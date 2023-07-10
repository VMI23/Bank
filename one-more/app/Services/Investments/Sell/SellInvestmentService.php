<?php
declare(strict_types=1);

namespace App\Services\Investments\Sell;

use App\Models\Holding;
use App\Models\InvestmentHistory;

class SellInvestmentService
{

    public function execute(SellInvestmentRequest $request) : void
    {
        $investmentAccount = auth()->user()->investmentAccount;
        $investmentAccount->addAndSave($request->getInvestment());

        $holding = Holding::firstOrCreate([
            'symbol' => $request->getSymbol(),
            'investment_account_id' => $investmentAccount->id,
        ]);

        $holding->subtractAndSave($request->getAmount());

        $holdingId = $holding->id;
        $investmentHistory = InvestmentHistory::create([
            'holding_id' => $holdingId,
            'amount_sold' => $request->getAmount(),
            'price_sold' => $request->getPrice(),
            'selling_date' => now(),
        ]);
    }

}
