<?php
declare(strict_types=1);

namespace App\Services\Accounts;

use App\Models\Transaction;

class WithdrawalService
{
    public function withdrawal($account, $amount)
    {
        $account->withdrawal($amount);

        Transaction::create([
            'sender_account_id' => $account->id,
            'currency' => $account->currency,
            'type' => 'withdrawal',
            'amount' => $amount,
            'direction' => 'outgoing',
            'rate' => 1,
            'amount_in_corresponding_currency' => $amount,
            'date' => now()
        ]);
    }

}
