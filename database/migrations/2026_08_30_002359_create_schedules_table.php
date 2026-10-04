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
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('teacher_id')
                ->index()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignUuid('class_id')
                ->index()
                ->constrained('classes')
                ->cascadeOnDelete();

            $table->foreignUuid('subject_id')
                ->index()
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('day')
                ->comment('1=Senin, 2=Selasa, 3=Rabu, 4=Kamis, 5=Jumat, 6=Sabtu, 7=Minggu');

            $table->time('start_time');
            $table->time('end_time');

            $table->timestamps();

            $table->index(['teacher_id', 'day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
