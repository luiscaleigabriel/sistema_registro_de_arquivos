<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, CanResetPassword;

    protected $fillable = [
        'nome',
        'email',
        'senha', // ATENÇÃO: campo é 'senha', não 'password'
        'bi',
        'data_nasc',
        'morada',
        'telefone',
        'nivel_acesso',
        'ativo',
        'email_verificado_em'
    ];

    protected $hidden = [
        'senha', // Esconder o campo 'senha'
        'remember_token',
    ];

    protected $casts = [
        'email_verificado_em' => 'datetime',
        'ativo' => 'boolean',
        'data_nasc' => 'date',
    ];

    /**
     * Sobrescrever para usar o campo 'senha' em vez de 'password'
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * Get the email address for password reset.
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     */
    public function sendPasswordResetNotification($token)
    {
        // Usar notificação padrão do Laravel
        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
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
