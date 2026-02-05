<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use SoftDeletes;

    protected $table = 'administradores';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'codigo_admin',
        'nivel_permissao',
        'pode_gerenciar_usuarios',
        'pode_gerar_relatorios',
        'pode_configurar_sistema'
    ];

    protected $casts = [
        'pode_gerenciar_usuarios' => 'boolean',
        'pode_gerar_relatorios' => 'boolean',
        'pode_configurar_sistema' => 'boolean',
    ];

    // Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Métodos de verificação de permissão
    public function podeGerenciarUsuarios()
    {
        return $this->pode_gerenciar_usuarios;
    }

    public function podeGerarRelatorios()
    {
        return $this->pode_gerar_relatorios;
    }

    public function podeConfigurarSistema()
    {
        return $this->pode_configurar_sistema;
    }

    public function isSuperAdmin()
    {
        return $this->nivel_permissao === 'super';
    }
}
