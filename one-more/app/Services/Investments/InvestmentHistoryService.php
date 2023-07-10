<?php
declare(strict_types=1);

namespace App\Services\Investments;

class InvestmentHistoryService
{

    public function getInvestmentHistory($user, $symbol)
    {
        $investmentAccount = $user->investmentAccount;
        $holdings = $investmentAccount->holdings->where('symbol', $symbol)->first();

        if ($holdings) {
            return $holdings->investmentHistory->where('holding_id', $holdings->id);
        }

        return null;
    }
}
