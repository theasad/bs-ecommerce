<?php

namespace repositories;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use models\CategoryModel;

class CategoryRepository
{
    protected CategoryModel $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    /**
     * @return bool|array
     */
    public function getRootCategorySummary(): bool|array
    {
        return $this->model->getRootCategorySummary();
    }

    /**
     * @return bool|array
     */
    public function getCategoryTree(): bool|array
    {
        return $this->model->getCategoryTree();
    }
}