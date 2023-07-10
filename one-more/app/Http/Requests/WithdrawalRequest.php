<?php

namespace App\Http\Requests;

use App\Rules\InsufficientFundsRule;
use App\Rules\OtpRule;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawalRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'sender_account_number' => 'exists:accounts,account_number',
            'amount' => ['required', 'numeric', 'min:0.01', new InsufficientFundsRule],
            'secret' => ['required', new OtpRule],

        ];
    }
}
