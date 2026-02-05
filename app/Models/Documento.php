<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'documentos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'processo_id',
        'inscricao_id',
        'tipo',
        'nome_arquivo',
        'caminho_arquivo',
        'extensao',
        'tamanho',
        'status',
        'observacoes_validacao',
        'enviado_por',
        'validado_por',
        'data_envio',
        'data_validacao'
    ];

    protected $casts = [
        'data_envio' => 'datetime:d/m/Y H:i',
        'data_validacao' => 'datetime:d/m/Y H:i',
        'tamanho' => 'decimal:2',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];

    // Relacionamentos
    public function processo()
    {
        return $this->belongsTo(Processo::class, 'processo_id');
    }

    public function inscricao()
    {
        return $this->belongsTo(Inscricao::class, 'inscricao_id');
    }

    public function remetente()
    {
        return $this->belongsTo(User::class, 'enviado_por');
    }

    public function validador()
    {
        return $this->belongsTo(User::class, 'validado_por');
    }

    // Scopes
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    public function scopeValidados($query)
    {
        return $query->where('status', 'validado');
    }

    public function scopeRejeitados($query)
    {
        return $query->where('status', 'rejeitado');
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function scopePorProcesso($query, $processoId)
    {
        return $query->where('processo_id', $processoId);
    }

    // Métodos
    public function validarFormato()
    {
        $formatosPermitidos = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
        $extensao = strtolower($this->extensao);

        return in_array($extensao, $formatosPermitidos);
    }

    public function validarTamanho()
    {
        $tamanhoMaximo = 5120; // 5MB em KB
        return $this->tamanho <= $tamanhoMaximo;
    }

    public function validarDocumento($validadorId, $status, $observacoes = null)
    {
        $this->status = $status;
        $this->validado_por = $validadorId;
        $this->observacoes_validacao = $observacoes;
        $this->data_validacao = now();
        $this->save();
    }

    public function aprovar($validadorId, $observacoes = null)
    {
        $this->validarDocumento($validadorId, 'validado', $observacoes);
    }

    public function rejeitar($validadorId, $observacoes = null)
    {
        $this->validarDocumento($validadorId, 'rejeitado', $observacoes);
    }

    public function getTamanhoFormatadoAttribute()
    {
        $tamanho = $this->tamanho;
        $unidades = ['KB', 'MB', 'GB'];
        $unidade = 0;

        while ($tamanho >= 1024 && $unidade < count($unidades) - 1) {
            $tamanho /= 1024;
            $unidade++;
        }

        return number_format($tamanho, 2) . ' ' . $unidades[$unidade];
    }

    public function getStatusFormatadoAttribute()
    {
        $statuses = [
            'pendente' => 'Pendente',
            'validado' => 'Validado',
            'rejeitado' => 'Rejeitado'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getTipoFormatadoAttribute()
    {
        $tipos = [
            'bi' => 'Bilhete de Identidade',
            'certificado' => 'Certificado de Habilitações',
            'fotografia' => 'Fotografia',
            'comprovativo' => 'Comprovativo de Residência',
            'declaracao' => 'Declaração',
            'outro' => 'Outro Documento'
        ];

        return $tipos[$this->tipo] ?? $this->tipo;
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($documento) {
            if (empty($documento->data_envio)) {
                $documento->data_envio = now();
            }
        });

    }
}
