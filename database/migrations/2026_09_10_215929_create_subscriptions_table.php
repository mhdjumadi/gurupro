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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('package_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('type', [
                'default',
                'custom',
            ])->default('default');

            $table->enum('status', [
                'active',
                'pending',
                'expired',
                'cancelled',
            ])->default('active')->index();

            // Snapshot harga dan limit saat subscription dibuat
            $table->decimal('price', 12, 2);

            $table->unsignedInteger('class_limit');

            $table->unsignedInteger('student_limit');

            $table->timestamp('started_at')->nullable();

            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
