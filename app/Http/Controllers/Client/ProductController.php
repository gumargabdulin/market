<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = ProductResource::collection(Product::whereNull('parent_id')->get())->resolve();
        return Inertia::render('Client/Product/Index', compact('products'));
    }
}
