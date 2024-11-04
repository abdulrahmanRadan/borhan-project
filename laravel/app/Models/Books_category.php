<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Books_category extends Model
{
    use HasFactory, Notifiable ;
    
    protected $table = 'books_categories';
    protected $fillable = [
        'name', 'slug', 'description', 'photo','user_id','is_visible'
    ];
    protected static function boot(){
        parent::boot();

        static::updating(function ($bCategory){
            if($bCategory->isDirty('photo') && $bCategory->getOriginal('photo')){
                Storage::disk('public')->delete($bCategory->getOriginal('photo'));
            }
        });
        static::deleting(function($bCategory){
            if(!empty($bCategory->photo)){
                Storage::disk('public')->delete($bCategory->photo);
            }
            // Soft delete related books
            // $bCategory->books()->delete();
        });
        
    }
    

    public function book():HasMany
    {
        return $this->hasMany(Book::class);
    }
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}