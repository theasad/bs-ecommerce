<?php

const DIRECT_ACCESS_ALLOWED = FALSE;
require 'vendor/autoload.php';
require 'helper/helpers.php';
require 'routes/Route.php';
/*
 *  Load routes configurations
 */
\routes\Route::init();
