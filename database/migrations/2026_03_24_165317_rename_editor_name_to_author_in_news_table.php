<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->renameColumn('editor_name', 'author_name');
            $table->string('author_type')->default('admin')->after('body'); // 'admin' or 'outside'
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->renameColumn('author_name', 'editor_name');
            $table->dropColumn('author_type');
        });
    }
};
