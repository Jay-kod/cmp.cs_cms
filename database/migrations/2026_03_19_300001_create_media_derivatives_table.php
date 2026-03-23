<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_derivatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_file_id')->constrained('media_files')->cascadeOnDelete();

            $table->string('format'); // webp
            $table->unsignedInteger('width')->nullable(); // image width (px)

            // Path relative to `public` disk, for example:
            // media/123/webp/320/foo.webp
            $table->string('path');

            // pending | processing | ready | failed
            $table->string('status')->default('pending');
            $table->text('error_message')->nullable();

            $table->timestamps();

            $table->unique(['media_file_id', 'format', 'width'], 'media_derivatives_unique_format_width');
            $table->index(['format', 'width', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_derivatives');
    }
};

