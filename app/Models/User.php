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
        'email',
        'nickname',
        'password',
        'type' // Adicione este campo se existir
    ];

    protected $hidden = ['password', 'remember_token'];

    // Mantenha apenas uma relação para client
    public function client()
    {
        return $this->hasOne(Client::class, 'user_id');
    }

    // Mantenha apenas uma relação para company
    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    // Relação para carrinho
public function cartItems()
{
    return $this->hasMany(Cart::class, 'user_id');
}

    // Relação para biblioteca
    public function libraryItems()
    {
        return $this->hasMany(Library::class, 'user_id');
    }
   public function games()
{
    return $this->hasMany(Game::class, 'company_id');
}
}
