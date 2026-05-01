<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Convert any existing 'clap' and 'celebrate' reactions to 'like'
     * since those types are being replaced by 'dislike' and 'angry'.
     */
    public function up(): void
    {
        DB::table('reactions')->where('type', 'clap')->update(['type' => 'like']);
        DB::table('reactions')->where('type', 'celebrate')->update(['type' => 'like']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversible — the original clap/celebrate data cannot be recovered
    }
};
