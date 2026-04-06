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
        Schema::table('past_hods', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('rank')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('area_of_specialization')->nullable();
            $table->string('status')->nullable();
            $table->string('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('past_hods', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'phone',
                'rank',
                'qualifications',
                'area_of_specialization',
                'status',
                'position'
            ]);
        });
    }
};
