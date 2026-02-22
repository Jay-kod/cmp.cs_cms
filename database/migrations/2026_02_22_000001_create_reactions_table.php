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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news')->cascadeOnDelete();
            $table->string('type');          // like, love, clap, insightful, celebrate
            $table->string('session_id');    // visitor identifier (session based)
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->unique(['news_id', 'session_id']); // one reaction per visitor per article
            $table->index(['news_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
