<?php

namespace App\Http\Requests;

use App\Rules\CannotTransferToSameAccountRule;
use App\Rules\InsufficientFundsRule;
use App\Rules\InvalidAccountNumberRule;
use App\Rules\OtpRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'sender_account_number' => ['required', new InvalidAccountNumberRule, ],
            'receiver' => ['required', new InvalidAccountNumberRule, new CannotTransferToSameAccountRule],
            'amount' => ['required', 'numeric', 'min:0.01', new InsufficientFundsRule],
            'receiverName' => 'required|exists:users,name',
            'secret' => ['required', new OtpRule],
        ];
    }
}
