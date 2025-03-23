<?php

namespace App\Exceptions;

class InvalidCredentialsException extends Exception
{
    protected function getDefaultMessage(): string
    {
        return __('auth.failed');
    }
}
