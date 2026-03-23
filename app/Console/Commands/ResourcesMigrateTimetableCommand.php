<?php

namespace App\Console\Commands;

use App\Models\ResourceCategory;
use App\Models\ResourceItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResourcesMigrateTimetableCommand extends Command
{
    protected $signature = 'resources:migrate-timetable {--dry-run : Do not write any DB changes}';

    protected $description = 'Migrate timetable files from storage/app/public/timetable into DB resources under timetable category.';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $category = ResourceCategory::query()
            ->where('slug', 'timetable')
            ->first();

        if (! $category) {
            $this->error('Missing ResourceCategory with slug=timetable. Run db:seed first.');
            return self::FAILURE;
        }

        $disk = Storage::disk('public');
        $files = $disk->files('timetable');

        if (empty($files)) {
            $this->warn('No files found in public disk directory timetable/. Nothing to migrate.');
            return self::SUCCESS;
        }

        // Pick the latest modified file as the active one.
        $files = collect($files)->map(function (string $path) use ($disk) {
            return [
                'path' => $path, // relative to disk (e.g. timetable/department-timetable.pdf)
                'mtime' => $disk->lastModified($path),
            ];
        })->sortByDesc('mtime')->values();

        $activePath = $files->first()['path'];

        $this->info('Timetable migration starting...');
        $this->line('Active file (latest): ' . $activePath);
        $this->line('Dry-run: ' . ($dryRun ? 'yes' : 'no'));

        // Deactivate existing timetable resources (for UX consistency), only if we're migrating.
        if (! $dryRun) {
            ResourceItem::query()
                ->where('category_id', $category->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $migrated = 0;
        foreach ($files as $file) {
            $path = $file['path'];
            $isActive = ($path === $activePath);

            /** @var ResourceItem|null $existing */
            $existing = ResourceItem::query()
                ->where('category_id', $category->id)
                ->where('file_path', $path)
                ->first();

            if ($existing) {
                if (! $dryRun) {
                    $existing->update([
                        'title' => $existing->title ?: 'Departmental Timetable',
                        'is_active' => $isActive,
                        'uploaded_at' => $existing->uploaded_at ?: now(),
                    ]);
                }
                $migrated++;
                continue;
            }

            if ($dryRun) {
                $this->line("[dry-run] Would create resource: {$path} active=" . ($isActive ? 'yes' : 'no'));
                continue;
            }

            $filename = basename($path);
            $title = 'Departmental Timetable';
            // If there are multiple extensions, include extension in title for clarity.
            $title = Str::startsWith(Str::lower($filename), Str::lower('department-timetable.'))
                ? $title
                : $title;

            ResourceItem::create([
                'category_id' => $category->id,
                'title' => $title,
                'description' => null,
                'file_path' => $path,
                'uploaded_at' => now(),
                'uploaded_by' => null,
                'is_active' => $isActive,
                'sort_order' => 0,
            ]);

            $migrated++;
        }

        $this->info("Timetable migration completed. Upserted rows: {$migrated}");
        return self::SUCCESS;
    }
}

