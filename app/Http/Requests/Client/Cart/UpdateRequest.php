<?php

namespace App\Http\Requests\Client\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id'=>'required|integer|exists:products,id',
            'qty'=>'required|integer|min:1',
        ];
    }
}
