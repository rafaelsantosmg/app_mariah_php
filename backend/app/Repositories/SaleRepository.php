<?php

namespace App\Repositories;

use App\Interfaces\SaleInterface;
use App\Models\Sale;

class SaleRepository implements SaleInterface
{
  public function getAll()
  {
    return Sale::all();
  }

  public function getById(int $id)
  {
    return Sale::find($id);
  }

  public function getByCode(string $code)
  {
    return Sale::where('code', $code)->first();
  }

  public function create(array $data)
  {
    return Sale::create($data);
  }

  public function update(int $id, array $data)
  {
    $sale = Sale::find($id);
    if ($sale) {
      $sale->update($data);
      return $sale;
    }
    return null;
  }

  public function delete(int $id)
  {
    return Sale::delete($id);
  }
}
