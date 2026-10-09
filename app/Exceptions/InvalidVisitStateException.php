<?php

declare(strict_types=1);

namespace App\Exceptions;

final class InvalidVisitStateException extends BusinessRuleException
{
    public function __construct(string $message = 'Invalid visit state.')
    {
        parent::__construct($message);
    }
}