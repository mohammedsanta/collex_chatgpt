<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table): void {
            $table->id();
            $table->string('reference_number', 30)->unique();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();
            $table->foreignId('debt_case_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('logged_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('subject', 255);
            $table->text('description');
            $table->string('source', 30)->nullable();
            $table->string('priority', 20)->default('medium');
            $table->string('status', 20)->default('open');
            $table->timestamp('due_at')->nullable();
            $table->text('resolution')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['bank_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index(['priority', 'due_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
