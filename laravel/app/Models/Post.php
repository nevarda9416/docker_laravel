<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends BaseModel
{
    use HasFactory, Sluggable; 

    /**
     * The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = [
        'title', 'slug', 'content', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of setTitleAttribute
     * @param mixed $value
     * @return void
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->generateSlug($value);
    }
}
