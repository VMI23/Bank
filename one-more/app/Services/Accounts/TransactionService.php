<?php

declare(strict_types=1);

namespace App\Services\Accounts;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    public function transfer(Account $sender, Account $receiver, float $amount, $conversionResult): void
    {
        $transaction = Transaction::create([
            'sender_account_id' => $sender->id,
            'receiver_account_id' => $receiver->id,
            'receiver_user_id' => $receiver->user_id,
            'currency' => $receiver->currency,
            'type' => 'transaction',
            'amount' => $amount,
            'direction' => 'outgoing',
            'rate' => $conversionResult->getRate(),
            'amount_in_corresponding_currency' => $conversionResult->getAmountInCurrency(),
            'date' => now(),
        ]);

        $sender->withdrawal($amount);
        $receiver->deposit($conversionResult->getAmountInCurrency());
    }

    public function getTransactionHistory(Collection $accounts): Collection
    {
        return Transaction::with([
            'sender_account.user:id,name',
            'receiver_account.user:id,name'
        ])
            ->whereIn('sender_account_id', $accounts->pluck('id'))
            ->orWhereIn('receiver_account_id', $accounts->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->get();
    }


}
