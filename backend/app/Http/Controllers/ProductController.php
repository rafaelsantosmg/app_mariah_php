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
        return $this->productService->getAllProducts();
    }

    public function show($id)
    {
        return $this->productService->getProductById($id);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'        => 'required|string|unique:products,code',
            'costPrice'   => 'required|numeric|min:0',
            'name'        => 'required|string',
            'salePrice'   => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'stockType'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error('Unprocessable Entity', HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());
        }

        return $this->productService->createProduct($request->all());
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'costPrice'   => 'sometimes|numeric|min:0',
            'name'        => 'sometimes|string',
            'salePrice'   => 'sometimes|numeric|min:0',
            'stock'       => 'sometimes|integer|min:0',
            'stockType'   => 'sometimes|string',
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