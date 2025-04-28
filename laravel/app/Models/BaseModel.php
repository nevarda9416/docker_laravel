<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BaseModel extends Model
{
    /**
     * Summary of scopeWhereBinary
     * @param mixed $query
     * @param mixed $field
     * @param mixed $value
     */
    public function scopeWhereBinary($query, $field, $value)
    {
        return $query->whereRaw('BINARY LOWER(' . $field . ') = "' . strtolower($value) . '"');
    }

    /**
     * Summary of createMany
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function createMany(array $data): Collection
    {
        $models = [];
        foreach ($data as $key => $value) {
            $models[$key] = static::create($value);
        }
        return new Collection($models);
    }
}
