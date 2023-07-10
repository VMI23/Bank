<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use PragmaRX\Google2FA\Google2FA;

class OtpRule implements Rule
{
    private Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }


    public function passes($attribute, $value)
    {
        return $this->google2fa->verifyKey(auth()->user()->google2fa_secret,
            $value);
    }


    public function message()
    {
        return 'OTP is not valid.';
    }
}
