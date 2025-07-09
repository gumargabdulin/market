<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public static function store(array $data): Product
    {
        $product = Product::create($data['product']);
        ImageService::storeBatch($product, $data);
        return $product;
    }

    public static function update(Product $product, array $data): Product
    {
        $product->update($data['product']);
        return $product->fresh();
    }
}
