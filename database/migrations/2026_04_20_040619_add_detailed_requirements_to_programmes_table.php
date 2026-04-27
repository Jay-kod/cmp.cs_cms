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
        Schema::table('programmes', function (Blueprint $table) {
            $table->string('req_olevel')->nullable()->after('objectives');
            $table->string('req_alevel')->nullable()->after('req_olevel');
            $table->string('req_utme_subjects')->nullable()->after('req_alevel');
            $table->string('req_utme_score')->nullable()->after('req_utme_subjects');
            $table->string('req_pg_core')->nullable()->after('req_utme_score');
            $table->string('req_pg_academic')->nullable()->after('req_pg_core');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropColumn([
                'req_olevel',
                'req_alevel',
                'req_utme_subjects',
                'req_utme_score',
                'req_pg_core',
                'req_pg_academic'
            ]);
        });
    }
};
