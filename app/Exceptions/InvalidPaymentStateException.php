<?php

declare(strict_types=1);

namespace App\Exceptions;

final class InvalidPaymentStateException extends BusinessRuleException
{
    public function __construct(string $message = 'Invalid payment state.')
    {
        parent::__construct($message);
    }
}