<?php

declare(strict_types=1);

namespace App\Exceptions;

final class AssignmentCapacityExceededException extends BusinessRuleException
{
    public function __construct()
    {
        parent::__construct('Collector assignment capacity has been exceeded.');
    }
}