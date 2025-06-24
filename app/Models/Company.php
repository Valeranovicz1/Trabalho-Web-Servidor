<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false; // Adicione esta linha

    protected $fillable = [
        'user_id',
        'website',
        'cnpj' // Adicione este campo
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


