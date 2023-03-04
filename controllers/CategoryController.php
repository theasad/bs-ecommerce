<?php

namespace controllers;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use services\CategoryService;

class CategoryController extends BaseController
{
    protected CategoryService $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    /**
     * @return void
     */
    public function rootCategory(): void
    {
        $rootCategories = $this->service->rootCategory();
        $content = $this->view("rootCategory", compact('rootCategories'));
        echo $this->layout($content);
    }

    /**
     * @return void
     */
    public function categoryTree(): void
    {
        $categoryTree = $this->service->categoryTree();
        $content = $this->view("categoryTree", compact('categoryTree'));
        echo $this->layout($content);
    }
}


