<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('collex:health', function (): void {
    $this->info('Collex console bootstrap is available.');
})->purpose('Verify that the Collex console is bootstrapped.');
