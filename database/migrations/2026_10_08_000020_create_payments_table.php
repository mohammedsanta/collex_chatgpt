<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table): void {
            $table->id();
            $table->string('receipt_number', 30)->unique();
            $table->foreignId('debt_case_id')->constrained()->restrictOnDelete();
            $table->foreignId('collector_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('promise_id')->nullable()->constrained('promises_to_pay')->nullOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('method', 30);
            $table->string('reference', 100)->nullable();
            $table->string('proof_path')->nullable();
            $table->timestamp('paid_at');
            $table->string('status', 20)->default('pending');
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('confirmed_at')->nullable();
            $table->string('rejection_reason', 1000)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['debt_case_id', 'status']);
            $table->index(['collector_id', 'paid_at']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
