<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public static function store(array $data): Product
    {
        $product = Product::create($data['product']);
        ProductService::arrachBatchParams($product, $data);
        ImageService::storeBatch($product, $data);
        return $product;
    }

    public static function update(Product $product, array $data): Product
    {
        $product->update($data['product']);
        ImageService::storeBatch($product, $data);
        return $product->fresh();
    }

    public static function arrachBatchParams(Product $product, array $data): void
    {
        foreach ($data['params'] as $param) {
            $product->params()->attach($param['id'], ['value' => $param['id']]);
        }
    }
}
