<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('performance_snapshots', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedInteger('cases_assigned')->default(0);
            $table->unsignedInteger('cases_processed')->default(0);
            $table->unsignedInteger('promises_total')->default(0);
            $table->unsignedInteger('promises_kept')->default(0);
            $table->unsignedInteger('promises_broken')->default(0);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->decimal('target_amount', 15, 2)->default(0);
            $table->decimal('efficiency', 8, 2)->default(0);
            $table->unsignedInteger('rank_position')->nullable();
            $table->timestamp('calculated_at');
            $table->timestamps();
            $table->unique(['user_id', 'bank_id', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_snapshots');
    }
};
