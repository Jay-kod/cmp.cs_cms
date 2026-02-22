<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programme_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // e.g. "Undergraduate (Full-Time)"
            $table->string('slug')->unique();   // e.g. "undergraduate-full-time"
            $table->text('description')->nullable();
            $table->string('icon')->nullable();  // Font Awesome class
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programme_categories');
    }
};
