<?php

namespace App\Services;

use App\Http\Resources\DailyMovementResource;
use App\Repositories\DailyMovementRepository;

class DailyMovementService
{
  protected $dailyMovementRepository;

  public function __construct(DailyMovementRepository $dailyMovementRepository)
  {
    $this->dailyMovementRepository = $dailyMovementRepository;
  }

  public function getAllDailyMovements()
  {
    $dailyMovements = $this->dailyMovementRepository->getAll();

    return DailyMovementResource::collection($dailyMovements->all());
  }
}
