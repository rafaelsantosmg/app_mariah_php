<?php

namespace App\Http\Controllers;

use App\Services\DailyMovementService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DailyMovementController
{
  use HttpResponses;

  protected $dailyMovementService;

  public function __construct(DailyMovementService $dailyMovementService)
  {
    $this->dailyMovementService = $dailyMovementService;
  }
  public function index()
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function show($id)
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function showDate($date)
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function create()
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function store(Request $request)
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }
}
