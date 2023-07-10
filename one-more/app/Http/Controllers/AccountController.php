<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\WithdrawalRequest;
use App\Models\Account;
use App\Services\Accounts\DepositService;
use App\Services\Accounts\TransactionService;
use App\Services\Accounts\WithdrawalService;
use App\Services\Currencies\FiatCurrencies\Show\ShowFiatCurrencyRequest;
use App\Services\Currencies\FiatCurrencies\Show\ShowFiatCurrencyService;

class AccountController extends Controller
{
    private ShowFiatCurrencyService $showFiatCurrencyService;
    private TransactionService $transactionService;
    private WithdrawalService $withdrawalService;
    private DepositService $depositService;

    public function __construct(
        ShowFiatCurrencyService $showFiatCurrencyService,
        TransactionService $transactionService,
        WithdrawalService $withdrawalService,
        DepositService $depositService
    ) {
        $this->showFiatCurrencyService = $showFiatCurrencyService;
        $this->transactionService = $transactionService;
        $this->withdrawalService = $withdrawalService;
        $this->depositService = $depositService;
    }

    // Account-related methods
    public function index()
    {
        $accounts = auth()->user()->accounts;


        return view('accounts.accounts', [
            'accounts' => $accounts
        ]);
    }

    public function store(AccountStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();
        Account::create($attributes);

        return redirect()->route('accounts')->with('success', 'Account created');
    }

    public function create()
    {
        return view('accounts.create');
    }

    // Deposit-related methods
    public function depositView()
    {
        $account = auth()->user()->accounts()->where('id', request()->account_id)->first();


        return view('accounts.deposit', [
            'account' => $account
        ]);
    }

    public function deposit(DepositRequest $request)
    {

        $validated = $request->validated();
        $accountNumber = $validated['account_number'];
        $amount = $validated['amount'];

        $account = $this->getAccountByNumber($accountNumber);

        $this->depositService->deposit($account, $amount);

        return redirect()->route('accounts')->with('success', 'Deposit successful');
    }

    // Withdrawal-related methods

    private function getAccountByNumber(string $accountNumber): ?Account
    {
        return auth()->user()->accounts()->where('account_number', $accountNumber)->first();
    }

    public function withdrawalView()
    {
        $account = auth()->user()->accounts()->where('id', request()->account_id)->first();

        return view('accounts.withdrawal', [
            'account' => $account
        ]);
    }

    // Transfer-related methods

    public function withdrawal(WithdrawalRequest $request)
    {
        $validated = $request->validated();
        $amount = $validated['amount'];
        $senderAccountNumber = $validated['sender_account_number'];

        $account = $this->getAccountByNumber($senderAccountNumber);

        $this->withdrawalService->withdrawal($account, $amount);

        return redirect()->route('accounts')->with('success', 'Withdrawal successful');
    }

    public function transferView()
    {
        $userAccount = auth()->user()->accounts()->where('id', request()->account_id)->first();
        $allAccounts = Account::all();

        return view('accounts.transfer', [
            'userAccount' => $userAccount,
            'allAccounts' => $allAccounts
        ]);
    }

    public function transfer(TransactionRequest $request)
    {
        $validated = $request->validated();
        $amount = $validated['amount'];
        $senderAccountNumber = $validated['sender_account_number'];
        $receiverAccountNumber = $validated['receiver'];

        $sender = $this->getAccountByNumber($senderAccountNumber);
        $receiver = Account::where('account_number', $request['receiver'])
            ->first();

        $converted = $this->showFiatCurrencyService->execute(
            new ShowFiatCurrencyRequest(
                $sender->currency,
                $receiver->currency,
                $amount
            )
        );

        $this->transactionService->transfer($sender, $receiver, $amount, $converted);

        return redirect()->route('accounts')->with('success', 'Transfer successful');
    }
}
