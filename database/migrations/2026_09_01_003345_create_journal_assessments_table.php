<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('journal_assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('teaching_journal_id')
                ->constrained('teaching_journals')
                ->cascadeOnDelete();

            $table->foreignUuid('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->string('name');

            $table->decimal('score', 5, 2)->nullable();

            $table->timestamps();

            $table->unique([
                'teaching_journal_id',
                'student_id',
                'name',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_assesments');
    }
};
