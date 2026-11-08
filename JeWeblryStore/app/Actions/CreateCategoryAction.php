<?php

namespace App\Actions;

use App\Models\Category;

class CreateCategoryAction
{
    /**
     * Create a category from validated data.
     */
    public function execute(array $categoryData): Category
    {
        return Category::create($categoryData);
    }
}
