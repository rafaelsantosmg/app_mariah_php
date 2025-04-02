<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'opening_balance',
        'closing_balance',
        'total_sales',
        'cash_sales',
        'pix_sales',
        'debit_card_sales',
        'credit_card_sales_cash',
        'credit_card_sales_installment',
    ];
}
