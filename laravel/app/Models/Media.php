<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'is_visible',
        'published_at', 'created_at'
    ];

    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}