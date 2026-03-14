<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->string('status')->default('Tenure')->after('specialisation');
        });

        // Migrate existing is_active data: active -> Tenure, inactive -> keep but mark
        DB::table('staff')->where('is_active', true)->update(['status' => 'Tenure']);
        DB::table('staff')->where('is_active', false)->update(['status' => 'Tenure']);

        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('specialisation');
        });

        DB::table('staff')->where('status', 'Tenure')->update(['is_active' => true]);
        DB::table('staff')->whereIn('status', ['Visiting', 'Sabbatical'])->update(['is_active' => true]);

        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
