<?php

declare(strict_types=1);

namespace App\Exceptions;

final class SystemAccountException extends BusinessRuleException
{
    public function __construct()
    {
        parent::__construct('System accounts cannot be modified.');
    }
}