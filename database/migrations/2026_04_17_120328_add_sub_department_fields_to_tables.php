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
        if (!Schema::hasColumn('sub_departments', 'founded_year')) {
            Schema::table('sub_departments', function (Blueprint $table) {
                $table->string('founded_year')->nullable()->after('name');
            });
        }

        if (!Schema::hasColumn('programmes', 'sub_department_id')) {
            Schema::table('programmes', function (Blueprint $table) {
                $table->foreignId('sub_department_id')->nullable()->constrained('sub_departments')->nullOnDelete()->after('id');
            });
        }

        if (!Schema::hasColumn('staff', 'sub_department_id')) {
            Schema::table('staff', function (Blueprint $table) {
                $table->foreignId('sub_department_id')->nullable()->constrained('sub_departments')->nullOnDelete()->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_departments', function (Blueprint $table) {
            $table->dropColumn('founded_year');
        });

        Schema::table('programmes', function (Blueprint $table) {
            $table->dropForeign(['sub_department_id']);
            $table->dropColumn('sub_department_id');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign(['sub_department_id']);
            $table->dropColumn('sub_department_id');
        });
    }
};
