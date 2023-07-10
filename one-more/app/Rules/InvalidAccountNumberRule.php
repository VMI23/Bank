<?php

namespace App\Rules;

use App\Models\Account;
use Illuminate\Contracts\Validation\Rule;

class InvalidAccountNumberRule implements Rule
{

    public function __construct()
    {

    }


    public function passes($attribute, $value)
    {
        $account = Account::where('account_number', $value)->first();
        return $account ? true : false;
    }


    public function message()
    {
        return 'Invalid account number.';
    }
}
