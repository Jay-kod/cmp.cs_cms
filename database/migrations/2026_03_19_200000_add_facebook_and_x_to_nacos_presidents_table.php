<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $hasFacebook = Schema::hasColumn('nacos_presidents', 'facebook');
        $hasX = Schema::hasColumn('nacos_presidents', 'x');

        Schema::table('nacos_presidents', function (Blueprint $table) use ($hasFacebook, $hasX) {
            if (! $hasFacebook) {
                $table->string('facebook')->nullable();
            }

            if (! $hasX) {
                $table->string('x')->nullable();
            }
        });
    }

    public function down(): void
    {
        $hasFacebook = Schema::hasColumn('nacos_presidents', 'facebook');
        $hasX = Schema::hasColumn('nacos_presidents', 'x');

        Schema::table('nacos_presidents', function (Blueprint $table) use ($hasFacebook, $hasX) {
            if ($hasFacebook) {
                $table->dropColumn('facebook');
            }

            if ($hasX) {
                $table->dropColumn('x');
            }
        });
    }
};

