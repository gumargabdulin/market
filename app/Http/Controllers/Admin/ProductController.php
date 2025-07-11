<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\ProductGroup\ProductGroupResource;
use App\Models\Category;
use App\Models\Param;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Services\ProductService;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::whereNull('parent_id')->get();
        $products = ProductResource::collection($products)->resolve();
        return inertia('Admin/Product/Index', compact('products'));
    }

    public function indexChild(Product $product)
    {
        return $product = ProductResource::collection($product->children)->resolve();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $productGroups = ProductGroupResource::collection(ProductGroup::all())->resolve();
        $params = ParamResource::collection(Param::all())->resolve();
        return inertia('Admin/Product/Create', compact('categories', 'productGroups', 'params'));
    }

    public function createChild(Product $product)
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $productGroups = ProductGroupResource::collection(ProductGroup::all())->resolve();
        $params = ParamResource::collection(Param::all())->resolve();
        $product = ProductResource::make($product)->resolve();
        return inertia('Admin/Product/CreateChild', compact('categories', 'productGroups', 'params', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validationData();
        $product = ProductService::store($data);
        return ProductResource::make($product)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = ProductResource::make($product)->resolve();
        return inertia('Admin/Product/Show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $productGroups = ProductGroupResource::collection(ProductGroup::all())->resolve();
        $product = ProductResource::make($product)->resolve();
        $params = ParamResource::collection(Param::all())->resolve();
        return inertia('Admin/Product/Edit', compact('product', 'categories', 'productGroups', 'params'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validationData();
        $product = ProductService::update($product, $data);
        return ProductResource::make($product)->resolve();
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], \Illuminate\Http\Response::HTTP_OK);
    }
}
