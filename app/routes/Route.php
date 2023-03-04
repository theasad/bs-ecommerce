<?php

namespace App\Routes;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

class Route
{
    public static function init(): void
    {
        // retrieve the request method and URI
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $project_path = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        // Remove project path from request URI
        $uri = DIRECTORY_SEPARATOR . str_replace($project_path, '', $_SERVER['REQUEST_URI']);

        // remove query string from URI
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        // define routes
        $routes = [
            '/' => ['controller' => 'App\Controllers\HomeController', 'method' => 'home'],
            '/root-category' => ['controller' => 'App\Controllers\CategoryController', 'method' => 'rootCategory'],
            '/category-tree' => ['controller' => 'App\Controllers\CategoryController', 'method' => 'categoryTree'],
        ];

        // match the route
        $matchedRoute = null;
        foreach ($routes as $route => $config) {
            if (preg_match('#^' . $route . '$#', $uri)) {
                $matchedRoute = $config;
                break;
            }
        }

        // execute the controller method
        if ($matchedRoute) {
            $controller = new $matchedRoute['controller']();
            $method = $matchedRoute['method'];
            $controller->$method();
        } else {
            http_response_code(404);
            echo "Page not found.";
        }
    }
}