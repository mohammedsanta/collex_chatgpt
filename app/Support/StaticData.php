<?php

declare(strict_types=1);

namespace App\Support;

final class StaticData
{
    public static function paymentMethods(): array { return ['cash','e_wallet','bank_transfer','card','cheque']; }
    public static function clientPhoneLabels(): array { return ['primary','alternate','work','other']; }
    public static function supportedLocales(): array { return ['ar','en']; }
    private function __construct() {}
}
