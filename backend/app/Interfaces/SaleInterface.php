<?php

namespace App\Interfaces;

interface SaleInterface
{
  public function getAll();

  public function getById(int $id);

  public function create(array $data);

  public function delete(int $id);
}
