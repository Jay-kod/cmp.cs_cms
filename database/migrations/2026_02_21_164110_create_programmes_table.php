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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('level'); // BSc, MSc, PhD, HND
            $table->string('duration')->nullable();
            $table->string('mode_of_study')->nullable();
            $table->text('description')->nullable();
            $table->text('objectives')->nullable();
            $table->text('requirements_utme')->nullable();
            $table->text('requirements_de')->nullable();
            $table->text('career_pathways')->nullable();
            $table->string('handbook_pdf')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
