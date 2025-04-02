<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Helpers\HttpStatus;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductById($id)
    {
        try {
            $product = $this->productRepository->getById($id);

            if (!$product) {
                throw new \App\Exceptions\ErrorHandler('Product not found', HttpStatus::NOT_FOUND);
            }

            return response()->json($product, HttpStatus::OK);
        } catch (\App\Exceptions\ErrorHandler $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    private function searchProductsByCode($code)
    {
        $product = $this->productRepository->getByCode($code);

        if (!$product) {
            return null;
        }

        return $product;
    }

    public function createProduct(array $data)
    {
        try {
            $product = $this->searchProductsByCode($data['code']);

            if ($product) {
                throw new \App\Exceptions\ErrorHandler('product already exists', HttpStatus::BAD_REQUEST);
            }

            $newProduct = [
                'code'          => $data['code'],
                'name'          => $data['name'],
                'description'   => $data['description'] ?? null,
                'cost_price'    => $data['costPrice'],
                'sale_price'    => $data['salePrice'],
                'profit_margin' => $data['salePrice'] - $data['costPrice'],
                'image'         => $data['image'] ?? null,
                'stock'         => $data['stock'],
                'stock_type'    => $data['stockType'],
                'created_at'    => $data['createdAt']?? now(),
                'updated_at'    => $data['updatedAt']?? now(),
            ];

            return $this->productRepository->create($newProduct);
        } catch (\App\Exceptions\ErrorHandler $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function updateProduct($id, $data)
    {
        try {
            $product = $this->productRepository->getById($id);

            if (!$product) {
                throw new \App\Exceptions\ErrorHandler('product not found', HttpStatus::NOT_FOUND);
            }

            $updateProduct = [
                'name'          => $data['name'],
                'description'   => $data['description'] ?? null,
                'cost_price'    => $data['costPrice'],
                'sale_price'    => $data['salePrice'],
                'profit_margin' => $data['salePrice'] - $data['costPrice'],
                'image'         => $data['image'] ?? null,
                'stock'         => $data['stock'],
                'stock_type'    => $data['stockType'],
                'updated_at'    => $data['updatedAt']?? now(),
            ];

            return $this->productRepository->update($id, $updateProduct);
        } catch (\App\Exceptions\ErrorHandler $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}
