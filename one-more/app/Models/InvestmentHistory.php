<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentHistory extends Model
{
    use HasFactory;


    protected $fillable = [
        'holding_id',
        'amount_bought',
        'amount_sold',
        'price_bought',
        'price_sold',
        'purchase_date',
        'selling_date'
    ];
}
