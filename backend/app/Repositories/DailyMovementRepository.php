<?php

namespace App\Repositories;

use App\Models\DailyMovement;

class DailyMovementRepository
{
  public function getAll()
  {
    return DailyMovement::all();
  }

  public function getById(int $id)
  {
    return DailyMovement::find($id);
  }

  public function getByDate(string $date)
  {
    return DailyMovement::where('date', $date)->first();
  }

  public function create(array $data)
  {
    return DailyMovement::create($data);
  }
}
