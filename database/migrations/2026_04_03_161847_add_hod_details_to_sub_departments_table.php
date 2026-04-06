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
        Schema::table('sub_departments', function (Blueprint $table) {
            $table->text('about_short')->nullable();
            $table->string('hod_name')->nullable();
            $table->string('hod_title')->nullable();
            $table->text('hod_message')->nullable();
            $table->string('hod_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            $table->dropColumn(['about_short', 'hod_name', 'hod_title', 'hod_message', 'hod_image']);
        });
    }
};
