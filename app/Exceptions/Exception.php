<?php

namespace App\Exceptions;

use \Throwable;

class Exception extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            $message ?: $this->getDefaultMessage(),
            $code ?: $this->getDefaultCode(),
            $previous
        );
    }

    protected function getDefaultMessage(): string
    {
        return '';
    }

    protected function getDefaultCode(): int
    {
        return 0;
    }
}
