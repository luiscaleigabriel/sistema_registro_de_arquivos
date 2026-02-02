<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duracao',
        'period',
        'description',
    ];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function students()
    {
        return $this->belongsTo(Estudante::class);
    }
}
