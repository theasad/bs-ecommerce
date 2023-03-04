<?php

use App\Helper\Config;

defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');
if (!function_exists('config')) {
    /**
     * @throws Exception
     */
    function config(string $key, mixed $default = null)
    {
        return Config::get($key, $default);
    }
}


if (!function_exists('buildTree')) {
    function buildTree($categories, $parentId = 0): array
    {
        $tree = array();
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $totalItems = getTotalItems($categories, $category['id']);
                $category['total_items'] = $totalItems;
                $children = buildTree($categories, $category['id']);
                if (!empty($children)) {
                    $category['children'] = $children;
                }
                $tree[] = $category;
            }
        }
        return $tree;
    }
}

if (!function_exists('getTotalItems')) {
    function getTotalItems($categories, $categoryId): int
    {
        $totalItems = 0;
        foreach ($categories as $category) {
            if ($category['parent_id'] == $categoryId) {
                $totalItems += getTotalItems($categories, $category['id']);
            }
        }

        $filterCategories = array_filter($categories, function ($category) use ($categoryId) {
            return $category['id'] == $categoryId;
        });
        foreach ($filterCategories as $filterCategory) {
            $totalItems += $filterCategory['total_items'];
        }
        return $totalItems;
    }
}


if (!function_exists('getChild')) {
    function getChild($categories, $categoryId): array
    {
        $child = [];
        foreach ($categories as $category) {
            if ($category['parent_id'] == $categoryId) {
                $child = array_merge($child, getChild($categories, $category['id']));
            }
        }

        return array_merge($child, array_filter($categories, function ($category) use ($categoryId) {
            return $category['parent_id'] == $categoryId;
        }));
    }
}


if (!function_exists('buildCategoryTreeHTML')) {
    function buildCategoryTreeHTML($categories, $parentId = null): string
    {
        $html = '<ul>';
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $totalItems = getTotalItems($categories, $category['id']);
                $child = getChild($categories, $category['id']);
                $cssClass = 'font-light dark text-sm';
                if ($category['parent_id'] === null) {
                    $cssClass = 'font-black	text-xl';
                } elseif (!empty($child)) {
                    $cssClass = 'font-semibold text-base';
                }

                $html .= '<li>';
                $html .= '<span class="category-name ' . $cssClass . '">' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $category['level']) . ' ' . $category['name'] . ' (' . $totalItems . ')</span>';
                $html .= buildCategoryTreeHTML($categories, $category['id']);
                $html .= '</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
}


if (!function_exists('base_url')) {
    function base_url($path = '')
    {
        // Get the protocol and hostname
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $url .= "://" . $_SERVER['HTTP_HOST'];

        // Get the project path
        $project_path = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        // Return the base URL
        return $url . $project_path . $path;
    }
}
