<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'date','is_visible','user_id','video','category_id'
    ];

    // Ensure old files are deleted when new ones are uploaded
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($video) {
            if ($video->isDirty('video')&& $video->getOriginal('video')) {
                Storage::disk('public')->delete($video->getOriginal('video'));
            }
            
        });

        static::deleting(function ($video) {
            if (!empty($video->video)) {
                Storage::disk('public')->delete($video->video);
            }
            
        });
    }

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}