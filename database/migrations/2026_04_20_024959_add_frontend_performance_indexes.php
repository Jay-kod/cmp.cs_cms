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
        $indexes = [
            'staff' => ['is_active', 'sort_order', 'role_id'],
            'news' => ['is_published', 'featured', 'views_count'],
            'events' => ['start_date', 'status', 'is_published'],
            'programmes' => ['sort_order'],
            'courses' => ['semester', 'level', 'is_active'],
            'gallery_images' => ['album_id', 'sort_order'],
            'gallery_albums' => ['is_published', 'sort_order'],
            'carousel_slides' => ['is_active', 'sort_order'],
            'nacos_presidents' => ['academic_session', 'sort_order'],
            'past_hods' => ['start_year', 'end_year'],
        ];

        foreach ($indexes as $tableName => $columns) {
            if (\Schema::hasTable($tableName)) {
                $sm = \Schema::getConnection()->getDoctrineSchemaManager();
                $existingIndexes = array_keys($sm->listTableIndexes($tableName));
                
                \Schema::table($tableName, function (Blueprint $table) use ($tableName, $columns, $existingIndexes) {
                    foreach ($columns as $column) {
                        if (\Schema::hasColumn($tableName, $column)) {
                            $indexName = strtolower($tableName . '_' . $column . '_index');
                            if (!in_array($indexName, $existingIndexes)) {
                                $table->index($column);
                            }
                        }
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
