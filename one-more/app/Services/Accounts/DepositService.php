<?php
declare(strict_types=1);

namespace App\Services\Accounts;

use App\Models\Transaction;

class DepositService
{
    public function deposit($account, $amount)
    {
        Transaction::create([
            'receiver_account_id' => $account->id,
            'receiver_user_id' => $account->user_id,
            'currency' => $account->currency,
            'type' => 'deposit',
            'amount' => $amount,
            'direction' => 'incoming',
            'rate' => 1,
            'amount_in_corresponding_currency' => $amount,
            'date' => now()
        ]);

        $account->deposit($amount);
    }

}
