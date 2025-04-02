<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function getById(int $id)
    {
        return Product::find($id);
    }

    public function getByCode(string $code)
    {
        return Product::where('code', $code)->first();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(int $id, array $data)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete(int $id)
    {
        return Product::delete($id);
    }
}