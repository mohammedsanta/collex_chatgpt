<?php

declare(strict_types=1);

namespace App\Exceptions;

final class InvalidPromiseStateException extends BusinessRuleException
{
    public function __construct(string $message = 'Invalid promise state.')
    {
        parent::__construct($message);
    }
}