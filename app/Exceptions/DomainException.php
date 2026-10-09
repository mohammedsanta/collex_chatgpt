<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class DomainException extends \RuntimeException
{
    public function __construct(
        string $message = 'A business rule has been violated.',
        public readonly ?string $errorCode = null,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, 0, $previous);
    }
}
