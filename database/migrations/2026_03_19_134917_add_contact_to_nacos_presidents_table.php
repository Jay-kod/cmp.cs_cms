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
        $hasEmail = Schema::hasColumn('nacos_presidents', 'email');
        $hasWhatsapp = Schema::hasColumn('nacos_presidents', 'whatsapp');

        Schema::table('nacos_presidents', function (Blueprint $table) use ($hasEmail, $hasWhatsapp) {
            if (! $hasEmail) {
                $table->string('email')->nullable();
            }

            if (! $hasWhatsapp) {
                $table->string('whatsapp')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $hasEmail = Schema::hasColumn('nacos_presidents', 'email');
        $hasWhatsapp = Schema::hasColumn('nacos_presidents', 'whatsapp');

        Schema::table('nacos_presidents', function (Blueprint $table) use ($hasEmail, $hasWhatsapp) {
            if ($hasEmail) {
                $table->dropColumn('email');
            }

            if ($hasWhatsapp) {
                $table->dropColumn('whatsapp');
            }
        });
    }
};
