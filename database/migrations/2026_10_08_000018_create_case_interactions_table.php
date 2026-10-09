<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('case_interactions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('debt_case_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('client_phone_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type', 20);
            $table->string('outcome', 30)->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->timestamp('occurred_at');
            $table->timestamp('followup_at')->nullable();
            $table->timestamps();
            $table->index(['debt_case_id', 'occurred_at']);
            $table->index(['user_id', 'occurred_at']);
            $table->index('followup_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_interactions');
    }
};
