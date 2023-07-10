<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_account_id',
        'receiver_account_id',
        'receiver_user_id',
        'currency',
        'type',
        'amount',
        'direction',
        'rate',
        'amount_in_corresponding_currency',
        'date'

    ];


    public function sender_account()
    {
        return $this->belongsTo(Account::class, 'sender_account_id');
    }

    public function receiver_account()
    {
        return $this->belongsTo(Account::class, 'receiver_account_id');
    }
}
