<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->foreignId('programme_category_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('programme_categories')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropForeign(['programme_category_id']);
            $table->dropColumn('programme_category_id');
        });
    }
};
