<?php

namespace App\Services;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository();
    }

    /**
     * @return bool|array
     */
    public function rootCategory(): bool|array
    {
        return $this->repository->getRootCategorySummary();
    }

    /**
     * @return string|null
     */
    public function categoryTree(): ?string
    {
        $categories = $this->repository->getCategoryTree();
        $categoryTree = null;
        if ($categories)
            $categoryTree = buildCategoryTreeHTML($categories);

        return $categoryTree;
    }
}