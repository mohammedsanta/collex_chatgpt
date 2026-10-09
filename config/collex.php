<?php

return [
    'currency' => env('COLLEX_DEFAULT_CURRENCY', 'EGP'),
    'client_code_prefix' => env('COLLEX_CLIENT_CODE_PREFIX', 'CL'),
    'client_code_start' => (int) env('COLLEX_CLIENT_CODE_START', 1000000),
    'receipt_prefix' => env('COLLEX_RECEIPT_PREFIX', 'PAY'),
    'max_active_cases_per_collector' => (int) env('COLLEX_MAX_ACTIVE_CASES_PER_COLLECTOR', 250),
    'phone' => ['default_country_code' => '20', 'national_length' => 11],
    'imports' => ['max_file_size_kb' => 20480, 'allowed_extensions' => ['csv']],
    'exports' => ['disk' => env('COLLEX_EXPORT_DISK', 'local'), 'expires_after_hours' => 24],
];
