<?php

namespace App\Http\Controllers;

use App\Helpers\HttpStatus;
use App\Services\SaleService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController
{
  use HttpResponses;

  protected $saleService;

  public function __construct(SaleService $saleService)
  {
    $this->saleService = $saleService;
  }

  public function index()
  {
    try {
      $sales = $this->saleService->getAllSales();

      return $this->response('Sales', HttpStatus::OK, $sales);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function show($id)
  {
    try {
      $sale = $this->saleService->getSaleById($id);

      return $this->response('Sale', HttpStatus::OK, $sale);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'discount' => 'sometimes|numeric|min:0',
        'paymentInstallment' => 'sometimes|string',
        'paymentMethod' => 'sometimes|string|nullable',
        'products' => 'required|array',
        'products.*.productId' => 'required|integer|exists:products,id',
        'products.*.productCode' => 'required|string|exists:products,code',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.stockType' => 'required|string',
      ]);

      if ($validator->fails()) {
        return $this->error('Unprocessable Entity', HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());
      }

      $sale = $this->saleService->createSale($request->all());

      return $this->response('Sale created', HttpStatus::CREATED, $sale);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function storeSpun(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'products' => 'required|array',
        'products.*.productId' => 'required|integer|exists:products,id',
        'products.*.productCode' => 'required|string|exists:products,code',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.stockType' => 'required|string',
      ]);

      if ($validator->fails()) {
        return $this->error('Unprocessable Entity', HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());
      }

      $sale = $this->saleService->createSaleSpun($request->all());

      return $this->response('Sale spun created', HttpStatus::CREATED, $sale);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function destroy($id)
  {
    try {
      $this->saleService->deleteSale($id);

      return $this->response('Sale deleted', HttpStatus::NO_CONTENT);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }
}
