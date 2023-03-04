<?php

namespace App\Bootstrap;

class Bootstrap
{

    /**
     * @return void
     */
    public static function init(): void
    {
        \App\Helper\DotEnv::load(realpath('.') . '/.env');
        /*
         *  Load routes configurations
         */
        \App\Routes\Route::init();
    }
}