<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Helpers\HttpStatus;
use App\Http\Resources\ProductResource;
use App\Traits\HttpResponses;

class ProductService
{
  use HttpResponses;

  protected $productRepository;

  public function __construct(ProductInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  private function searchProductsByCode($code)
  {
    $product = $this->productRepository->getByCode($code);

    if (!$product) {
      return null;
    }

    return $product;
  }

  private function calcProfitMargin($data)
  {
    return $data['salePrice'] - $data['costPrice'];
  }

  public function getAllProducts()
  {
    $products = $this->productRepository->getAll();

    return ProductResource::collection($products->all());
  }

  public function getProductById($id)
  {
    $product = $this->productRepository->getById($id);

    if (!$product) {
      throw new \App\Exceptions\ErrorHandler('Product not found', HttpStatus::NOT_FOUND);
    }

    return new ProductResource($product);
  }

  public function createProduct(array $data)
  {
    $product = $this->searchProductsByCode($data['code']);

    if ($product) {
      return $this->error('Product already exists', HttpStatus::BAD_REQUEST);
    }

    $newProduct = [
      'code' => $data['code'],
      'name' => $data['name'],
      'description' => $data['description'] ?? null,
      'cost_price' => $data['costPrice'],
      'sale_price' => $data['salePrice'],
      'profit_margin' => $this->calcProfitMargin($data),
      'image' => $data['image'] ?? null,
      'stock' => $data['stock'],
      'stock_type' => $data['stockType'],
      'created_at' => $data['createdAt'] ?? now(),
      'updated_at' => $data['updatedAt'] ?? now(),
    ];

    $createProduct = $this->productRepository->create($newProduct);

    if (!$createProduct) {
      throw new \App\Exceptions\ErrorHandler('Product creation failed', HttpStatus::BAD_REQUEST);
    }

    return new ProductResource($createProduct);
  }

  public function updateProduct($id, $data)
  {
    $product = $this->productRepository->getById($id);

    if (!$product) {
      throw new \App\Exceptions\ErrorHandler('Product not found', HttpStatus::NOT_FOUND);
    }

    $updateProduct = [
      'name' => $data['name'],
      'description' => $data['description'] ?? null,
      'cost_price' => $data['costPrice'],
      'sale_price' => $data['salePrice'],
      'profit_margin' => $this->calcProfitMargin($data),
      'image' => $data['image'] ?? null,
      'stock' => $data['stock'],
      'stock_type' => $data['stockType'],
      'updated_at' => $data['updatedAt'] ?? now(),
    ];

    $updatedProduct = $this->productRepository->update($id, $updateProduct);

    return new ProductResource($updatedProduct);
  }

  public function deleteProduct($id)
  {
    $product = $this->productRepository->getById($id);

    if (!$product) {
      throw new \App\Exceptions\ErrorHandler('Product not found', HttpStatus::NOT_FOUND);
    }

    if (!$this->productRepository->delete($product)) {
      throw new \App\Exceptions\ErrorHandler('Failed to delete product', HttpStatus::INTERNAL_SERVER_ERROR);
    }
  }
}
