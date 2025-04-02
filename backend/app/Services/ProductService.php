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
        $productsResources =  ProductResource::collection($products);
        return $this->response('OK', HttpStatus::OK, $productsResources);
    }

    public function getProductById($id)
    {
        try {
            $product = $this->productRepository->getById($id);

            if (!$product) {
                return $this->error('Product not found', HttpStatus::NOT_FOUND);
            }

            $productResource = new ProductResource($product);

            return $this->response('OK', HttpStatus::OK, $productResource);
        } catch (\App\Exceptions\ErrorHandler $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function createProduct(array $data)
    {
        try {
            $product = $this->searchProductsByCode($data['code']);

            if ($product) {
                return $this->error('Product already exists', HttpStatus::BAD_REQUEST);
            }

            $newProduct = [
                'code'          => $data['code'],
                'name'          => $data['name'],
                'description'   => $data['description'] ?? null,
                'cost_price'    => $data['costPrice'],
                'sale_price'    => $data['salePrice'],
                'profit_margin' => $this->calcProfitMargin($data),
                'image'         => $data['image'] ?? null,
                'stock'         => $data['stock'],
                'stock_type'    => $data['stockType'],
                'created_at'    => $data['createdAt']?? now(),
                'updated_at'    => $data['updatedAt']?? now(),
            ];

            $createProduct = $this->productRepository->create($newProduct);

            if (!$createProduct) {
                return $this->error('Failed to create product', HttpStatus::BAD_REQUEST);
            }

            $createResource = new ProductResource($createProduct);

            return $this->response('CREATED', HttpStatus::CREATED, $createResource);
        } catch (\App\Exceptions\ErrorHandler $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function updateProduct($id, $data)
    {
        try {
            $product = $this->productRepository->getById($id);

            if (!$product) {
                return $this->error('Product not found', HttpStatus::NOT_FOUND);
            }

            $updateProduct = [
                'name'          => $data['name'],
                'description'   => $data['description'] ?? null,
                'cost_price'    => $data['costPrice'],
                'sale_price'    => $data['salePrice'],
                'profit_margin' => $this->calcProfitMargin($data),
                'image'         => $data['image'] ?? null,
                'stock'         => $data['stock'],
                'stock_type'    => $data['stockType'],
                'updated_at'    => $data['updatedAt']?? now(),
            ];

            $updatedProduct = $this->productRepository->update($id, $updateProduct);

            if (!$updatedProduct) {
                return $this->error('Failed to update product', HttpStatus::BAD_REQUEST);
            }

            $updatedProductResource = new ProductResource($updatedProduct);

            return $this->response('UPDATED', HttpStatus::OK, $updatedProductResource);
        } catch (\App\Exceptions\ErrorHandler $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = $this->productRepository->getById($id);

            if (!$product) {
                return $this->error('Product not found', HttpStatus::NOT_FOUND);
            }

            if (!$this->productRepository->delete($product)) {
                return $this->error('Failed to delete product', HttpStatus::INTERNAL_SERVER_ERROR);
            }

            return $this->response('NO CONTENT', HttpStatus::NO_CONTENT);

        } catch (\App\Exceptions\ErrorHandler $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}