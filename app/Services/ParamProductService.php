<?php

namespace App\Services;

use App\Models\Param;
use App\Models\ParamProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ParamProductService
{
    public static function replicateBatch(Product $product, $cloneProduct): void
    {
        foreach ($product->paramProducts as $paramProduct) {
            $cloneParamProduct = $paramProduct->replicate();
            $cloneParamProduct->product_id = $cloneProduct->id;
            $cloneParamProduct->push();
        }
    }

    public static function getGroupedByParamArray(Product $product): array
    {
        $paramProducts = ParamProduct::groupedByParams($product)->get()
        ->groupBy('param_id')->map(function ($paramProducts) {
            return [
                'title' => $paramProducts->first()->param->title,
                'data' => $paramProducts->toArray()
            ];
        });

        return array_values($paramProducts->toArray());
    }
}
