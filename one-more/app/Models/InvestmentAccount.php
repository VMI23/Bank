<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'balance',
        'currency',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($account) {
            $prefix = 'INVEST'; // Prefix for the account number
            $length = 10; // Desired length of the account number

            $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
            $accountNumber = $prefix . $randomNumber;

            $account->account_number = $accountNumber;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function holdings()
    {
        return $this->hasMany(Holding::class, 'investment_account_id');
    }

    public function subtractAndSave($amount)
    {
        $this->balance -= $amount;
        $this->save();
    }

    public function addAndSave($amount)
    {
        $this->balance += $amount;
        $this->save();
    }

}
