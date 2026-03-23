<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // image | video | file
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size_bytes')->nullable();

            // Path relative to the `public` disk (e.g. `staff_photos/foo.jpg`).
            $table->string('original_path');

            // Checksum used for idempotency/backfill/reporting.
            $table->string('checksum_sha256', 64)->nullable();

            // pending | processing | ready | failed
            $table->string('status')->default('pending');
            $table->text('error_message')->nullable();

            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['type', 'status']);
            $table->index(['original_path']);
            $table->index(['checksum_sha256']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};

