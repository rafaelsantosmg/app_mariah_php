<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cost_price',
        'sale_price',
        'profit_margin',
        'image',
        'stock',
        'stock_type',
        'code',
        'created_at',
        'updated_at',
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sales_product');
    }
}