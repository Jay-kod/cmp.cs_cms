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
        Schema::dropIfExists('alumnis');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('graduation_year', 4);
            $table->string('programme');
            $table->string('employer')->nullable();
            $table->string('current_role')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }
};
