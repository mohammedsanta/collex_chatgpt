<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('case_assignments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('debt_case_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('unassigned_at')->nullable();
            $table->string('reason', 500)->nullable();
            $table->timestamps();
            $table->index(['debt_case_id', 'unassigned_at']);
            $table->index(['user_id', 'unassigned_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_assignments');
    }
};
