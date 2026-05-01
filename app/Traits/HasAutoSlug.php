<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Automatically generates a unique slug when a model is created or updated.
 *
 * Usage: Add `use HasAutoSlug;` to your model, then define:
 *   - slugSource(): returns the attribute name to generate the slug from (default: 'name')
 *
 * The trait will auto-generate a slug on creating & updating events.
 * If a duplicate slug exists, it appends -2, -3, etc. to ensure uniqueness.
 */
trait HasAutoSlug
{
    public static function bootHasAutoSlug(): void
    {
        static::creating(function ($model) {
            $model->generateSlug();
        });

        static::updating(function ($model) {
            // Only regenerate slug if the source attribute changed
            $source = $model->slugSource();
            if ($model->isDirty($source)) {
                $model->generateSlug();
            }
        });
    }

    /**
     * The attribute to generate the slug from.
     */
    public function slugSource(): string
    {
        return 'name';
    }

    /**
     * Generate a unique slug for this model.
     */
    protected function generateSlug(): void
    {
        $source = $this->{$this->slugSource()};
        $slug = Str::slug($source);

        if (empty($slug)) {
            $slug = 'item-' . Str::random(6);
        }

        // Check for uniqueness
        $originalSlug = $slug;
        $counter = 2;
        $query = static::where('slug', $slug);

        // Exclude current model on updates
        if ($this->exists) {
            $query->where($this->getKeyName(), '!=', $this->getKey());
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $query = static::where('slug', $slug);
            if ($this->exists) {
                $query->where($this->getKeyName(), '!=', $this->getKey());
            }
            $counter++;
        }

        $this->slug = $slug;
    }
}
