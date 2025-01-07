<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function scopeWhereBinary($query, $field, $value)
    {
        return $query->whereRaw('BINARY LOWER(' . $field . ') = "' . strtolower($value) . '"');
    }
}
