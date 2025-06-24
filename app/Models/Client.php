<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients'; // Correção crucial!
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false; // Adicione esta linha

    protected $fillable = [
        'user_id',
        'date_of_birth',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
