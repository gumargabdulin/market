<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartWithProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_title' => $this->product_title,
            'product_image' => $this->product_image,
            'total_sum' =>$this->total_sum,
            'qty' => $this->qty,
        ];
    }
}
