<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'bi',
        'data_nasc',
        'morada',
        'telefone',
        'nivel_acesso',
        'ativo',
        'email_verificado_em'
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'email_verificado_em' => 'datetime',
        'ativo' => 'boolean',
        'data_nasc' => 'date:d/m/Y',
    ];

    // Método personalizado para obter a senha 
    public function getAuthPassword()
    {
        return $this->senha;
    }

    // Relacionamentos
    public function aluno()
    {
        return $this->hasOne(Aluno::class, 'usuario_id');
    }

    public function secretario()
    {
        return $this->hasOne(Secretario::class, 'usuario_id');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'usuario_id');
    }

    // Scopes
    public function scopeAtivos($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorNivel($query, $nivel)
    {
        return $query->where('nivel_acesso', $nivel);
    }

    // Métodos de verificação
    public function isAluno()
    {
        return $this->nivel_acesso === 'aluno';
    }

    public function isSecretario()
    {
        return $this->nivel_acesso === 'secretario';
    }

    public function isAdministrador()
    {
        return $this->nivel_acesso === 'administrador';
    }

    public function isAtivo()
    {
        return $this->ativo;
    }

    // Gerar número de aluno automático
    public static function gerarNumeroAluno()
    {
        $ano = date('Y');
        $sequencia = self::whereYear('created_at', $ano)->count() + 1;
        return 'AL' . $ano . str_pad($sequencia, 4, '0', STR_PAD_LEFT);
    }
}
