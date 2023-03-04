<?php

const DIRECT_ACCESS_ALLOWED = FALSE;
require __DIR__ . '/vendor/autoload.php';

/*
 *  Load routes configurations
 */
\app\routes\Route::init();
