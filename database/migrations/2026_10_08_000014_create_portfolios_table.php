<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->unsignedSmallInteger('period_year');
            $table->unsignedTinyInteger('period_month');
            $table->string('status', 20)->default('draft');
            $table->unsignedInteger('cases_count')->default(0);
            $table->decimal('total_debt', 15, 2)->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->foreignId('archived_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['bank_id', 'period_year', 'period_month']);
            $table->index(['bank_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
