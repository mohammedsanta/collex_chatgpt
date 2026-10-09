<?php

declare(strict_types=1);

use App\Support\Helpers\DateHelper;

test('returns the start and end of a calendar day', function (): void {
    expect(DateHelper::startOfDay('2026-10-09')->format('Y-m-d H:i:s'))->toBe('2026-10-09 00:00:00')
        ->and(DateHelper::endOfDay('2026-10-09')->format('Y-m-d H:i:s'))->toBe('2026-10-09 23:59:59');
});
