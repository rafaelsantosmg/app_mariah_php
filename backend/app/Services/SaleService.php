<?php

namespace App\Services;

use App\Helpers\HttpStatus;
use App\Http\Resources\SaleResource;
use App\Interfaces\SaleInterface;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SalesProduct;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;

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

    return SaleResource::collection($sales->all());
  }

  public function getSaleById($id)
  {
    $sale = $this->saleRepository->getById($id);

    if (!$sale) {
      throw new \App\Exceptions\ErrorHandler('Sale not found', HttpStatus::NOT_FOUND);
    }

    return new SaleResource($sale);
  }

  public function createSale(array $data)
  {
    return DB::transaction(function () use ($data) {
      $products = $this->verifyProducts($data);

      $totalPrice = $this->sumProducts($products);

      $salesPrice = $this->applyDiscount($data, $totalPrice);

      $sale = $this->saleRepository->create([
        'discount' => $data['discount'] ?? 0,
        'total_price' => round($totalPrice, 2),
        'sales_price' => round($salesPrice, 2),
      ]);

      $this->createPayment($sale->id, $data);

      $this->updateStock($products);

      $this->createSalesProduct($sale->id, $products);

      return new SaleResource($sale);
    });
  }

  public function deleteSale($id)
  {
    $sale = $this->saleRepository->getById($id);

    if (!$sale) {
      throw new \App\Exceptions\ErrorHandler('Sale not found', HttpStatus::NOT_FOUND);
    }

    if (!$this->saleRepository->delete($sale)) {
      throw new \App\Exceptions\ErrorHandler('Failed to delete sale', HttpStatus::INTERNAL_SERVER_ERROR);
    }
  }

  private function verifyProducts($data)
  {
    $products = collect($data['products'])->map(function ($product) {
      $productExist = Product::find($product['productId']);

      if (!$productExist) {
        throw new \App\Exceptions\ErrorHandler("Produto com ID nº {$product['productCode']} não encontrado.", HttpStatus::NOT_FOUND);
      }

      $productStock = $productExist->stock - $product['quantity'];
      if ($productStock < 0) {
        throw new \App\Exceptions\ErrorHandler("Produto com ID nº {$product['productCode']} sem estoque.", HttpStatus::BAD_REQUEST);
      }

      $productPrice = $productExist->name === 'PRODUTOS FIADO'
          ? $product['productPrice']
          : $productExist->sale_price;

      return collect($productExist)->merge([
        'quantity' => (int) $product['quantity'],
        'sale_price' => $productPrice,
      ]);
    });

    return $products;
  }

  private function sumProducts($products)
  {
    return $products->sum(fn ($product) => $product['sale_price'] * $product['quantity']);
  }

  private function applyDiscount($data, $totalPrice)
  {
    return isset($data['discount'])
    ? $totalPrice - ($totalPrice * $data['discount'] / 100)
    : $totalPrice;
  }

  private function updateStock($products)
  {
    $products->each(function ($product) {
      Product::where('code', $product['code'])->update([
        'stock' => $product['stock'] - $product['quantity'],
      ]);
    });
  }

  private function createPayment($saleId, $data)
  {
    if (isset($data['paymentMethod'])) {
      Payment::create([
        'payment_method' => $data['paymentMethod'],
        'payment_installment' => $data['paymentInstallment'] ?? null,
        'sale_id' => $saleId,
      ]);
    }
  }

  private function createSalesProduct($saleId, $products)
  {
    collect($products)->each(function ($product) use ($saleId) {
      SalesProduct::create([
        'sale_id' => $saleId,
        'product_id' => $product['productId'],
        'quantity' => $product['quantity'],
      ]);
    });
  }
}
