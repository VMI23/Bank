<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InsufficientHoldingsRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        $holding = auth()->user()->investmentAccount->holdings()
            ->where('symbol', request()->input('symbol'))->first();


        return $holding && $holding->amount >= request()->input('amount');
    }


    public function message()
    {
        return 'Insufficient amount of Holdings.';
    }
}
