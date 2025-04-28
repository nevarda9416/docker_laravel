<?php

namespace App\Traits;

trait Sluggable
{
    /**
     * Generate a slug from the given string.
     * Slug is not unique.
     */
    public function generateSlug(string $string): string
    {
        $slug = strtolower(str_replace(' ', '-', $string));
        $count = 1;
        while ($this->slugExists($slug)) {
            $slug = strtolower(str_replace(' ', '-', $string)).'-'.$count;
            $count++;
        }

        return $slug;
    }

    /**
     * Summary of slugExists.
     */
    private function slugExists(string $slug): mixed
    {
        return $this->where('slug', $slug)->exists();
    }
}
