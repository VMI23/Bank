<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InsufficientFundsInvestmentRule implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value): bool
    {

        $investmentAccount = auth()->user()->investmentAccount()->first();

        return $investmentAccount && $investmentAccount->balance >= request()->input('investment');
    }

    public function message(): string
    {
        return 'Insufficient funds in the Investment wallet!';
    }
}
