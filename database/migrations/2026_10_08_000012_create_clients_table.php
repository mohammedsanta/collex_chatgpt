<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table): void {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('national_id', 14)->unique();
            $table->string('name')->index();
            $table->string('email')->nullable();
            $table->foreignId('governorate_id')->nullable()->constrained()->nullOnDelete();
            $table->string('address', 500)->nullable();
            $table->string('employer_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('work_address', 500)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
