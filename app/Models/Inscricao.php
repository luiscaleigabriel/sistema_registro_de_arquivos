<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'nota_teste',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
