<?php

declare(strict_types=1);

namespace App\Exceptions;

final class ArchivedPortfolioException extends BusinessRuleException
{
    public function __construct()
    {
        parent::__construct('Archived portfolios are read-only.');
    }
}