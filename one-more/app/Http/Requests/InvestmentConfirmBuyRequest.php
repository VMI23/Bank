<?php

namespace App\Http\Requests;

use App\Rules\InsufficientFundsInvestmentRule;
use App\Rules\OtpRule;
use Illuminate\Foundation\Http\FormRequest;

class InvestmentConfirmBuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [

            'investment' => ['required', 'numeric', new InsufficientFundsInvestmentRule],
            'symbol' => ['required', 'string'],
            'amount' => ['required'],
            'secret' => ['required', 'numeric', new OtpRule],
            'price' => ['required', 'numeric'],

        ];
    }

}
