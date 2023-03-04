<?php

namespace controllers;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

class HomeController extends BaseController
{
    public function home()
    {
        $content = $this->view("home");
        echo $this->layout($content);
    }
}