<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('debt_cases', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->foreignId('loan_type_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('loan_number', 100)->nullable();
            $table->string('status', 20)->default('active');
            $table->decimal('total_debt', 15, 2)->default(0);
            $table->decimal('overdue_amount', 15, 2)->default(0);
            $table->decimal('installment_value', 15, 2)->nullable();
            $table->decimal('min_installment_diff', 15, 2)->nullable();
            $table->decimal('late_fee', 15, 2)->default(0);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->string('bucket', 30)->nullable();
            $table->unsignedInteger('dpd')->default(0);
            $table->date('next_due_date')->nullable();
            $table->date('loan_start_date')->nullable();
            $table->date('loan_end_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->decimal('last_payment_amount', 15, 2)->nullable();
            $table->boolean('is_processed')->default(false);
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['portfolio_id', 'client_id', 'loan_number']);
            $table->index(['bank_id', 'status']);
            $table->index(['assigned_user_id', 'status']);
            $table->index(['status', 'next_due_date']);
            $table->index('dpd');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debt_cases');
    }
};
