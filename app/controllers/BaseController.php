<?php

namespace App\Controllers;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

class BaseController
{
    /**
     * @param $name
     * @param array $data
     * @return bool|string
     */
    protected function view($name, array $data = []): bool|string
    {
        ob_start();
        extract($data);
        require_once "app/views/{$name}.php";
        return ob_get_clean();
    }

    /**
     * @param $content
     * @return bool|string
     */
    protected function layout($content): bool|string
    {
        ob_start();
        require_once "app/views/layout.php";
        return ob_get_clean();
    }
}