<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }


    public function rules()
    {
        return [

            'name' => 'required|max:255',
            'balance' => 'required|numeric',
            'currency' => 'required|max:255',

        ];
    }
}
