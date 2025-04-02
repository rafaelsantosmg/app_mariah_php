<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'code'         => $this->code,
            'name'         => $this->name,
            'description'  => $this->description,
            'costPrice'    => $this->cost_price,
            'salePrice'    => $this->sale_price,
            'profitMargin' => $this->profit_margin,
            'image'        => $this->image,
            'stock'        => $this->stock,
            'stockType'    => $this->stock_type,
            'createdAt'    => $this->created_at,
            'updatedAt'    => $this->updated_at,
        ];
    }
}