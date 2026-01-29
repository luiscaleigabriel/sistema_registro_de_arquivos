<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    use HasFactory;

    protected $fillable = [
        'numProcess',
        'status',
        'user_id',
        'student_id',
        'doc_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Estudante::class);
    }

    public function docs()
    {
        return $this->belongsToMany(Documento::class);
    }
}
