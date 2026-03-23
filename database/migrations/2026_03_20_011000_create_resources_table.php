<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('resource_categories')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            // Path relative to `public` disk, e.g. `resources/handbook/handbook.pdf`
            $table->string('file_path');

            // Only for UX sorting/display.
            $table->timestamp('uploaded_at')->nullable();

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['category_id', 'is_active', 'uploaded_at']);
            $table->index(['category_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};

