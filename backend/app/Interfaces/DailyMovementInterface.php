<?php

namespace App\Interfaces;

interface DailyMovementInterface
{
  public function getAll();

  public function getById(int $id);

  public function getByDate(string $date);

  public function create(array $data);
}
