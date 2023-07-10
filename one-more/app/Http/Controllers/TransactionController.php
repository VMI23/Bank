<?php

namespace App\Http\Controllers;

use App\Services\Accounts\TransactionService;

class TransactionController extends Controller
{
    private TransactionService $transactionService;
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $user = auth()->user();
        $accounts = $user->accounts;

        $transactionHistory = $this->transactionService->getTransactionHistory($accounts);

        return view('transactions.transactions', compact('accounts', 'transactionHistory'));
    }
}
