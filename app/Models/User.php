<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'password',
        'user_type',
        'nickname',
        'email',
    ];

    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['password' => 'hashed'];

    public function client()
    {
        return $this->hasOne(Client::class, 'user_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function libraryGames()
    {
        return $this->belongsToMany(Game::class, 'library', 'user_id', 'game_id')
                    ->withTimestamps();
    }
}
