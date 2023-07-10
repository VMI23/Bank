<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InsufficientFundsRule implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        $sender = auth()->user()->accounts()->where('account_number',
            request()->input('sender_account_number'))->first();


        return $sender && $sender->balance >= request()->input('amount');
    }


    public function message()
    {
        return 'Insufficient funds.';
    }
}
