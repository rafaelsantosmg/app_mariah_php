<?php

namespace App\dto;

class ProductDto
{
  /**
   * Create a new class instance.
   */
  public readonly string $name;
  public readonly string $description;

  public function __construct(string $name, string $description)
  {
    $this->name        = $name;
    $this->description = $description;
  }
}
