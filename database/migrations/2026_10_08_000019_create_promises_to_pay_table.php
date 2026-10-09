<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promises_to_pay', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('debt_case_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->decimal('promised_amount', 15, 2);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->date('promise_date');
            $table->string('status', 20)->default('active');
            $table->text('notes')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'promise_date']);
            $table->index(['debt_case_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promises_to_pay');
    }
};
