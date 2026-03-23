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
        Schema::table('news', function (Blueprint $table) {
            $table->string('type')->default('news')->after('slug');
            $table->string('department_code')->nullable()->after('type');
            $table->boolean('is_published')->default(true)->after('department_code');
            
            // To ensure compatibility with the previous blade template if it expects these exact columns:
            if (!Schema::hasColumn('news', 'image')) {
                $table->string('image')->nullable()->after('featured_image');
            }
            if (!Schema::hasColumn('news', 'content')) {
                $table->longText('content')->nullable()->after('body');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['type', 'department_code', 'is_published', 'image', 'content']);
        });
    }
};
