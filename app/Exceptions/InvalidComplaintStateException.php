<?php

declare(strict_types=1);

namespace App\Exceptions;

final class InvalidComplaintStateException extends BusinessRuleException
{
    public function __construct(string $message = 'Invalid complaint state.')
    {
        parent::__construct($message);
    }
}