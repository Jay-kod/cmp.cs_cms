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
        $tables = [
            'news', 'events', 'announcements', 'staff', 'programmes',
            'courses', 'carousel_slides', 'gallery_albums', 'partners',
            'publications', 'nacos_presidents', 'past_hods', 'pages',
            'department_settings'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $sm = Schema::getConnection()->getDoctrineSchemaManager();
                    $indexesFound = $sm->listTableIndexes($tableName);
                    
                    if (!array_key_exists($tableName.'_updated_at_index', $indexesFound)) {
                        $table->index('updated_at');
                    }
                });
            }
        }

        if (Schema::hasTable('news')) {
            Schema::table('news', function (Blueprint $table) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $indexesFound = $sm->listTableIndexes('news');
                if (!array_key_exists('news_published_at_index', $indexesFound)) {
                    $table->index('published_at');
                }
            });
        }

        if (Schema::hasTable('programmes')) {
            Schema::table('programmes', function (Blueprint $table) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $indexesFound = $sm->listTableIndexes('programmes');
                if (!array_key_exists('programmes_is_active_index', $indexesFound)) {
                    $table->index('is_active');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'news', 'events', 'announcements', 'staff', 'programmes',
            'courses', 'carousel_slides', 'gallery_albums', 'partners',
            'publications', 'nacos_presidents', 'past_hods', 'pages',
            'department_settings'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $sm = Schema::getConnection()->getDoctrineSchemaManager();
                    $indexesFound = $sm->listTableIndexes($tableName);
                    
                    if (array_key_exists($tableName.'_updated_at_index', $indexesFound)) {
                        $table->dropIndex([$tableName.'_updated_at_index']);
                    }
                });
            }
        }

        if (Schema::hasTable('news')) {
            Schema::table('news', function (Blueprint $table) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $indexesFound = $sm->listTableIndexes('news');
                if (array_key_exists('news_published_at_index', $indexesFound)) {
                    $table->dropIndex(['news_published_at_index']);
                }
            });
        }

        if (Schema::hasTable('programmes')) {
            Schema::table('programmes', function (Blueprint $table) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $indexesFound = $sm->listTableIndexes('programmes');
                if (array_key_exists('programmes_is_active_index', $indexesFound)) {
                    $table->dropIndex(['programmes_is_active_index']);
                }
            });
        }
    }
};
