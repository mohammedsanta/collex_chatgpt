<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_phones', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('phone', 20);
            $table->string('label', 20)->default('primary');
            $table->boolean('is_valid')->default(true);
            $table->timestamps();
            $table->unique(['client_id', 'phone']);
            $table->index('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_phones');
    }
};
