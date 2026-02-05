<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
    use SoftDeletes;

    protected $table = 'alunos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'numero_aluno',
        'curso',
        'ano_letivo',
        'status',
        'data_inscricao',
        'numero_processo'
    ];

    protected $casts = [
        'data_inscricao' => 'date:d/m/Y',
    ];

    // Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function processos()
    {
        return $this->hasMany(Processo::class, 'aluno_id');
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'aluno_id');
    }

    public function documentos()
    {
        return $this->hasManyThrough(Documento::class, Processo::class, 'aluno_id', 'processo_id');
    }

    // Scopes
    public function scopeAtivos($query)
    {
        return $query->where('status', 'ativo');
    }

    public function scopePorCurso($query, $curso)
    {
        return $query->where('curso', 'like', "%{$curso}%");
    }

    public function scopePorAnoLetivo($query, $ano)
    {
        return $query->where('ano_letivo', $ano);
    }
}
