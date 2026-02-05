<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Secretario extends Model
{
    use SoftDeletes;

    protected $table = 'secretarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'codigo_func',
        'departamento',
        'tipo',
        'data_admissao',
        'pode_arquivar',
        'pode_validar'
    ];

    protected $casts = [
        'data_admissao' => 'date:d/m/Y',
        'pode_arquivar' => 'boolean',
        'pode_validar' => 'boolean',
    ];

    // Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function processosAnalisados()
    {
        return $this->hasMany(Processo::class, 'analisado_por');
    }

    public function documentosValidados()
    {
        return $this->hasMany(Documento::class, 'validado_por');
    }
}
