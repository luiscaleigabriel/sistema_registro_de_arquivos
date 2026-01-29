<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'status',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processo()
    {
        return $this->hasOne(Processo::class);
    }
}
