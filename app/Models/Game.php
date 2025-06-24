<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'image',
        'price',
        'classification',
        'company_id',
    ];

public function company()
{
    return $this->belongsTo(User::class, 'company_id');
}

    public function owners()
    {
        return $this->belongsToMany(User::class, 'library', 'game_id', 'user_id');
    }
    public function getRouteKeyName()
{
    return 'id';
}
}
