<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'periodo',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function students()
    {
        return $this->belongsTo(Estudante::class);
    }
    
}
