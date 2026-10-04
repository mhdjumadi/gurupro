<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teaching_journals', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('teacher_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignUuid('schedule_id')
                ->constrained('schedules')
                ->cascadeOnDelete();

            $table->date('date');
            $table->enum('semester', ['ganjil', 'genap']);

            $table->time('start_time')->useCurrent();
            $table->time('end_time')->nullable();

            $table->text('material')->nullable();
            $table->text('activities')->nullable();
            $table->text('assessment')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_journals');
    }
};
