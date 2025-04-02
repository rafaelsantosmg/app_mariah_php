<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
        'installment',
        'sale_id',
    ];

    public function sales()
    {
        return $this->belongsTo(Sale::class, 'sales_id');
    }
}