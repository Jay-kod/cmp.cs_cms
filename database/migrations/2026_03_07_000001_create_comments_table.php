<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->string('author_name')->nullable();       // null = Anonymous
            $table->string('author_email')->nullable();
            $table->text('body');
            $table->string('session_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->boolean('is_approved')->default(true);    // auto-approve by default
            $table->timestamps();

            $table->index(['news_id', 'is_approved']);
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
