<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_departments', 'programme_count')) {
                $table->string('programme_count')->nullable()->after('student_population');
            }
            if (!Schema::hasColumn('sub_departments', 'course_count')) {
                $table->string('course_count')->nullable()->after('programme_count');
            }
            if (!Schema::hasColumn('sub_departments', 'lecturer_count')) {
                $table->string('lecturer_count')->nullable()->after('course_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            $table->dropColumn(['programme_count', 'course_count', 'lecturer_count']);
        });
    }
};
