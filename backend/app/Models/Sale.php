<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  use HasFactory;

  protected $fillable = [
    'discount',
    'total_price',
    'sales_price',
  ];

  public function products()
  {
    return $this->belongsToMany(Product::class, 'sales_product');
  }

  public function payments()
  {
    return $this->hasMany(Payment::class);
  }
}
