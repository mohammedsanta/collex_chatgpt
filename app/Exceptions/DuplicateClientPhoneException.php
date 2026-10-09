<?php

declare(strict_types=1);

namespace App\Exceptions;

final class DuplicateClientPhoneException extends BusinessRuleException
{
    public function __construct()
    {
        parent::__construct('This phone number already exists for the client.');
    }
}