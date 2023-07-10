<?php

namespace App\Http\Requests;

use App\Rules\OtpRule;
use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'account_number' => '|exists:accounts,account_number',
            'amount' => 'required|min:0|numeric',
            'secret' => ['required', new OtpRule],
        ];
    }
}
