<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\StoreRequest;
use App\Http\Requests\Client\Cart\UpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return inertia('Client/Cart/Index');
    }

    public function store(StoreRequest $request)
    {

        $cart = $request->validated();
        $cart = CartService::store($cart);
        return CartResource::make($cart)->resolve();
    }

    public function update(Cart $cart, UpdateRequest $request)
    {
        $data = $request->validated();
        $cart = CartService::update($cart, $data);
        return CartResource::make($cart)->resolve();
    }
}
