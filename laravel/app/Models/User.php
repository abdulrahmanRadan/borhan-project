<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function video():HasMany
    {
        return $this->hasMany(Video::class);
    }
    
    public function books_category():HasMany
    {
        return $this->hasMany(Books_category::class);
    }
    
    public function books():HasMany
    {
        return $this->hasMany(Book::class);
    }
    public function media():HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function comment():HasMany
    {
        return $this->hasMany(Comment::class);
    }




}