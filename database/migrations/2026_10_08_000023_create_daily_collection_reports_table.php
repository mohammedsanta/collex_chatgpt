<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daily_collection_reports', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->date('report_date');
            $table->unsignedInteger('cases_worked')->default(0);
            $table->unsignedInteger('calls_count')->default(0);
            $table->unsignedInteger('visits_count')->default(0);
            $table->unsignedInteger('promises_count')->default(0);
            $table->decimal('promised_amount', 15, 2)->default(0);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->string('status', 20)->default('draft');
            $table->timestamp('submitted_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['bank_id', 'user_id', 'report_date']);
            $table->index('report_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_collection_reports');
    }
};
