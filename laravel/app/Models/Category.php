<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'photo','user_id','is_visible'
    ];
    protected static function boot(){
        parent::boot();

        static::updating(function ($category){
            if($category->isDirty('photo') && $category->getOriginal('photo')){
                Storage::disk('public')->delete($category->getOriginal('photo'));
            }
        });
        static::deleting(function($category){
            if(!empty($category->photo)){
                Storage::disk('public')->delete($category->photo);
            }
        });
    }

    public function video():HasMany
    {
        return $this->hasMany(Video::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}