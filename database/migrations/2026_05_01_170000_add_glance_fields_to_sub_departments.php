<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_departments', 'faculty_name')) {
                $table->string('faculty_name')->nullable()->after('founded_year');
            }
            if (!Schema::hasColumn('sub_departments', 'student_population')) {
                $table->string('student_population')->nullable()->after('faculty_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            $table->dropColumn(['faculty_name', 'student_population']);
        });
    }
};
