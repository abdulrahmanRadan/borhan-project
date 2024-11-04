<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name', 'slug', 'description','author', 'photo', 'date','books_category_id','user_id','is_visible','pdf'
    ];

    
    // Ensure old files are deleted when new ones are uploaded
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($book) {
            if ($book->isDirty('photo')&& $book->getOriginal('photo')) {
                Storage::disk('public')->delete($book->getOriginal('photo'));
            }
            if ($book->isDirty('pdf')) {
                Storage::disk('public')->delete($book->getOriginal('pdf'));
            }
        });

        static::deleting(function ($book) {
            if (!empty($book->photo)) {
                Storage::disk('public')->delete($book->photo);
            }
            if (!empty($book->pdf)) {
                Storage::disk('public')->delete($book->pdf);
            }
        });
    }

    public function books_category():BelongsTo
    {
        return $this->belongsTo(Books_category::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function media():HasMany
    {
        return $this->hasMany(Media::class);
    }

}