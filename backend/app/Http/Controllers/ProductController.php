<?php

namespace App\Http\Controllers;

use App\Helpers\HttpStatus;
use App\Services\ProductService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController
{
  use HttpResponses;

  protected $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function index()
  {
    try {
      $products = $this->productService->getAllProducts();

      if (!$products) {
        return $this->error('No products found', HttpStatus::NOT_FOUND);
      }

      return $this->response('Products', HttpStatus::OK, $products);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function show($id)
  {
    try {
      $product = $this->productService->getProductById($id);

      if (!$product) {
        return $this->error('Product not found', HttpStatus::NOT_FOUND);
      }

      return $this->response('Product', HttpStatus::OK, $product);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'code' => 'required|string|unique:products,code',
        'costPrice' => 'required|numeric|min:0',
        'name' => 'required|string',
        'salePrice' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'stockType' => 'required|string',
      ]);

      if ($validator->fails()) {
        return $this->error('Unprocessable Entity', HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());
      }

      $product = $this->productService->createProduct($request->all());

      if (!$product) {
        return $this->error('Failed to create product', HttpStatus::BAD_REQUEST);
      }

      return $this->response('Product created', HttpStatus::CREATED, $product);
    } catch (\App\Exceptions\ErrorHandler $e) {
      return response()->json($e->getMessage(), $e->getCode());
    }
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'costPrice' => 'sometimes|numeric|min:0',
      'name' => 'sometimes|string',
      'salePrice' => 'sometimes|numeric|min:0',
      'stock' => 'sometimes|integer|min:0',
      'stockType' => 'sometimes|string',
    ]);

    if ($validator->fails()) {
      return $this->error('Unprocessable Entity', HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());
    }

    return $this->productService->updateProduct($id, $request->all());
  }

  public function destroy($id)
  {
    return $this->productService->getProductById($id);
  }
}
