<?php

namespace App\Exceptions;

use Exception;

class ErrorHandler extends Exception
{
    public function __construct(string $message = "Erro interno", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}