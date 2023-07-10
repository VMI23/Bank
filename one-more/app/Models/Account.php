<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'account_number',
        'balance',
        'currency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public static function boot()
    {
        parent::boot();

        self::creating(function ($account) {
            $prefix = 'AC'; // Prefix for the account number
            $length = 10; // Desired length of the account number

            $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
            $accountNumber = $prefix . $randomNumber;

            $account->account_number = $accountNumber;
        });
    }

    public function deposit($amount){
        $this->balance += $amount;
        $this->save();
    }

    public function withdrawal($amount){
        $this->balance -= $amount;
        $this->save();
    }

    public function transfer($amount, $account){
        $this->balance -= $amount;
        $account->balance += $amount;
        $this->save();
        $account->save();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'sender_account_id');
    }

    public function senderTransactions()
    {
        return $this->hasMany(Transaction::class, 'sender_account_id');
    }

    public function recipientTransactions()
    {
        return $this->hasMany(Transaction::class, 'recipient_account_id');
    }}
