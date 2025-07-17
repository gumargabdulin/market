<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public static function store(array $data): Category
    {
        return Category::create($data);
    }

    public static function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category->fresh();
    }

    public static function getCategoryChildren(Category $category): array
    {
        $arr = [];
        $categoryChildren = Category::where('parent_id', $category->id)->get();
        foreach ($categoryChildren as $categoryChild) {
            $arr = array_merge($arr, self::getCategoryChildren($categoryChild));
        }
        $arr[] = $category;
        return $arr;
    }
}
