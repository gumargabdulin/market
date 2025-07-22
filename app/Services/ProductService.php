<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public static function store(array $data): Product
    {
        try {
            DB::beginTransaction();
            $product = Product::create($data['product']);
            ProductService::attachBatchParams($product, $data);
            ImageService::storeBatch($product, $data);
            DB::commit();
        } catch (\Exception $exception) {
            abort(500, 'store transaction error');
            DB::rollBack();
        }
        return $product;
    }

    public static function update(Product $product, array $data): Product
    {
        try {
            $product->update($data['product']);
            ProductService::syncBatchParams($product, $data);
            ImageService::storeBatch($product, $data);
        } catch (\Exception $exception) {
            abort(500, 'update transaction error');
            DB::rollBack();
        }
        return $product->fresh();
    }

    public static function indexByCategories(Collection $categoryChildren): Collection
    {
        return Product::byCategories($categoryChildren)->get();
    }

    public static function attachBatchParams(Product $product, array $data): void
    {
        foreach ($data['params'] as $param) {
            $product->params()->attach($param['id'], ['value' => $param['value']]);
        }
    }

    public static function syncBatchParams(Product $product, array $data): void
    {
        $product->params()->detach();
        ProductService::attachBatchParams($product, $data);
    }
}
