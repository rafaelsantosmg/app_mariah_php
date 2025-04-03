<?php

namespace App\Interfaces;

interface ProductInterface
{
  public function getAll();

  public function getById(int $id);

  public function getByCode(string $code);

  public function create(array $data);

  public function update(int $id, array $data);

  public function delete(int $id);
}
