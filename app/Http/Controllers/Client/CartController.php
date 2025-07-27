<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\StoreRequest;
use App\Http\Requests\Client\Cart\UpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Http\Resources\Cart\CartWithProductAndTotalSumResource;
use App\Http\Resources\Cart\CartWithProductResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function index()
    {
        $carts = CartWithProductResource::collection(auth()->user()->carts)->resolve();
        return inertia('Client/Cart/Index', compact('carts'));
    }

    public function store(StoreRequest $request)
    {

        $cart = $request->validated();
        $cart = CartService::store($cart);
        return CartWithProductAndTotalSumResource::make($cart)->resolve();;
    }

    public function update(Cart $cart, UpdateRequest $request)
    {
        $data = $request->validated();
        $cart = CartService::update($cart, $data);
        return CartWithProductAndTotalSumResource::make($cart)->resolve();
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json([
            'message' => 'Cart deleted successfully',
        ], Response::HTTP_OK);
    }
}
