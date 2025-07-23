<?php

namespace App\Services;

use App\Models\Param;
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
}
