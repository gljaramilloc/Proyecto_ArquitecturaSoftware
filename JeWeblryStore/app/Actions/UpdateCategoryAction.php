<?php

namespace App\Actions;

use App\Models\Category;

class UpdateCategoryAction
{
    /**
     * Update a category with validated data.
     */
    public function execute(Category $category, array $categoryData): Category
    {
        $category->update($categoryData);

        return $category;
    }
}
