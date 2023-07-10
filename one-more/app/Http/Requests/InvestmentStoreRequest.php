<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentStoreRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => 'required',
            'balance' => 'required|numeric|min:0',
            'currency' => 'required|exists:iso_4217,code',
        ];
    }
}
