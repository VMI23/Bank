<?php

namespace App\Http\Requests;

use App\Rules\InsufficientHoldingsRule;
use App\Rules\OtpRule;
use Illuminate\Foundation\Http\FormRequest;

class InvestmentConfirmSellRequest extends FormRequest
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
            'amount' => ['required', 'numeric', new InsufficientHoldingsRule],
            'symbol' => ['required', 'string'],
            'secret' => ['required', 'numeric', new OtpRule],
            'price' => ['required', 'numeric'],

        ];
    }
}
