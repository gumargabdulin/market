<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductWithGroupedParamResource;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = ProductResource::collection(Product::whereNull('parent_id')->get())->resolve();
        return Inertia::render('Client/Product/Index', compact('products'));
    }

    public function show(Product $product)
    {
        $breadcrumbs=CategoryService::getCategoryParents($product->category);
        $breadcrumbs = CategoryResource::collection($breadcrumbs->push($product->category))->resolve();
        $product = ProductWithGroupedParamResource::make($product)->resolve();
        return Inertia::render('Client/Product/Show', compact('product', 'breadcrumbs'));
    }
}
