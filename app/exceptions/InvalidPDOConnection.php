<?php

namespace App\Exceptions;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use Exception;
use Throwable;

class InvalidPDOConnection extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}