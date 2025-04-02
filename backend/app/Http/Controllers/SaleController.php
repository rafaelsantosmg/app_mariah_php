<?php

namespace App\Http\Controllers;

use App\Helpers\HttpStatus;
use App\Http\Resources\SaleResource;
use App\Interfaces\SaleInterface;
use App\Traits\HttpResponses;

class SaleService
{
  use HttpResponses;

  protected $saleRepository;

  public function __construct(SaleInterface $saleRepository)
  {
    $this->saleRepository = $saleRepository;
  }

  public function getAllSales()
  {
    $sales = $this->saleRepository->getAll();
    $salesResources = SaleResource::collection($sales);

    return $this->response('OK', HttpStatus::OK, $salesResources);
  }

  public function getSaleById($id)
  {
    try {
      $sale = $this->saleRepository->getById($id);

      if (!$sale) {
        return $this->error('Sale not found', HttpStatus::NOT_FOUND);
      }

      $productResource = new SaleResource($sale);

      return $this->response('OK', HttpStatus::OK, $productResource);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function createSale(array $data)
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function updateSale($id, $data)
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function deleteSale($id)
  {
    try {
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }
}
