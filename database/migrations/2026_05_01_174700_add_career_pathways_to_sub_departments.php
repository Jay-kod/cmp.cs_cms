<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_departments', 'career_pathways')) {
                $table->json('career_pathways')->nullable()->after('lecturer_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            $table->dropColumn('career_pathways');
        });
    }
};
