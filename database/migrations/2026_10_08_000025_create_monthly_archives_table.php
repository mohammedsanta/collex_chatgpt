<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monthly_archives', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();
            $table->foreignId('portfolio_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedInteger('cases_count')->default(0);
            $table->decimal('total_debt', 15, 2)->default(0);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->string('snapshot_path')->nullable();
            $table->foreignId('archived_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('archived_at');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['bank_id', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_archives');
    }
};
