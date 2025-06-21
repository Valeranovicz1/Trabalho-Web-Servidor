<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends User
{
    use HasFactory;

    protected $table = 'users';
    public $incrementing = false;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'website',
    ];

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function game(){

        return $this->hasMany(Game::class);
    }

}
