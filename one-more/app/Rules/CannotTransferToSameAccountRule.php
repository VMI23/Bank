<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CannotTransferToSameAccountRule implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        $senderAccountNumber = request()->input('sender_account_number');

        var_dump($senderAccountNumber);
        return $senderAccountNumber !== $value;
    }


    public function message()
    {
        return 'You cannot transfer to the same account.';
    }
}
