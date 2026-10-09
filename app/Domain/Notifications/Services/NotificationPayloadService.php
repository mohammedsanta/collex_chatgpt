<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

final class NotificationPayloadService
{
    public function make(
        string $title,
        string $message,
        array $data = []
    ): array {
        return [
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ];
    }
}