<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Param\ParamResource;
use App\Http\Resources\Param\ParamWithPivotValueResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'article' => $this->article,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'category_id' => $this->category_id,
            'product_group_id' => $this->product_group_id,
            'qty' => $this->qty,
            'images' => ImageResource::collection($this->images)->resolve(),
            'preview_image_url' => $this->preview_image_url,
            'params' => ParamWithPivotValueResource::collection($this->params)->resolve()
        ];
    }
}
