<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holding extends Model
{
    use HasFactory;

    protected $fillable = [
        'investment_account_id',
        'symbol',
        'amount',
        'price_bought',
        'quantity_sold',
        'price_sold',
        '24h_change',
        'profit_loss',
        'date_bought',
        'date_sold',


    ];

    public function addAndSave($amount)
    {
        $this->amount += $amount;
        $this->save();
    }

    public function subtractAndSave($amount)
    {
        $this->amount -= $amount;
        $this->save();
    }

    public function investmentAccount()
    {
        return $this->belongsTo(InvestmentAccount::class);
    }

    public function investmentHistory()
    {
        return $this->hasMany(InvestmentHistory::class, 'holding_id');
    }


}
