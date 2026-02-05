<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscricao extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'inscricoes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'aluno_id',
        'processo_id',
        'data_inscricao',
        'tipo_inscricao',
        'status',
        'nota_teste',
        'resultado_teste',
        'observacoes',
        'avaliado_por',
        'data_avaliacao',
        'documentos_completos',
        'taxa_paga'
    ];

    protected $casts = [
        'data_inscricao' => 'date:d/m/Y',
        'data_avaliacao' => 'date:d/m/Y',
        'nota_teste' => 'decimal:2',
        'documentos_completos' => 'boolean',
        'taxa_paga' => 'boolean',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];

    // Relacionamentos
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'processo_id');
    }

    public function avaliador()
    {
        return $this->belongsTo(Usuario::class, 'avaliado_por');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'inscricao_id');
    }

    // Scopes
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    public function scopeSubmetidas($query)
    {
        return $query->where('status', 'submetida');
    }

    public function scopeEmAnalise($query)
    {
        return $query->where('status', 'em_analise');
    }

    public function scopeAprovadas($query)
    {
        return $query->where('status', 'aprovada');
    }

    public function scopePorAluno($query, $alunoId)
    {
        return $query->where('aluno_id', $alunoId);
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_inscricao', $tipo);
    }

    public function scopeComTesteAprovado($query)
    {
        return $query->where('resultado_teste', 'aprovado');
    }

    public function scopeDocumentosCompletos($query)
    {
        return $query->where('documentos_completos', true);
    }

    public function scopeTaxaPaga($query)
    {
        return $query->where('taxa_paga', true);
    }

    // Métodos
    public function validar()
    {
        if ($this->documentos_completos && $this->taxa_paga) {
            $this->status = 'submetida';
            $this->save();
            return true;
        }
        return false;
    }

    public function fazerInscricao()
    {
        $this->status = 'pendente';
        $this->data_inscricao = now();
        $this->save();
    }

    public function fazerTeste($nota)
    {
        $this->nota_teste = $nota;
        $this->resultado_teste = ($nota >= 10) ? 'aprovado' : 'reprovado';
        $this->save();
    }

    public function enviarDocumentos($documentos)
    {
        $this->documentos_completos = !empty($documentos);
        $this->save();
    }

    public function verResultado()
    {
        return [
            'status' => $this->status,
            'nota_teste' => $this->nota_teste,
            'resultado_teste' => $this->resultado_teste,
            'data_avaliacao' => $this->data_avaliacao,
            'observacoes' => $this->observacoes
        ];
    }

    public function iniciarAvaliacao($avaliadorId)
    {
        $this->status = 'em_analise';
        $this->avaliado_por = $avaliadorId;
        $this->data_avaliacao = now();
        $this->save();
    }

    public function aprovarInscricao($observacoes = null)
    {
        $this->status = 'aprovada';
        $this->observacoes = $observacoes;
        $this->save();
    }

    public function rejeitarInscricao($observacoes = null)
    {
        $this->status = 'rejeitada';
        $this->observacoes = $observacoes;
        $this->save();
    }

    // Acessors
    public function getStatusFormatadoAttribute()
    {
        $statuses = [
            'pendente' => 'Pendente',
            'submetida' => 'Submetida',
            'em_analise' => 'Em Análise',
            'aprovada' => 'Aprovada',
            'rejeitada' => 'Rejeitada'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getTipoInscricaoFormatadoAttribute()
    {
        $tipos = [
            'regular' => 'Regular',
            'reinscricao' => 'Reinscrição',
            'transferencia' => 'Transferência'
        ];

        return $tipos[$this->tipo_inscricao] ?? $this->tipo_inscricao;
    }

    public function getResultadoTesteFormatadoAttribute()
    {
        $resultados = [
            'aprovado' => 'Aprovado',
            'reprovado' => 'Reprovado',
            'pendente' => 'Pendente'
        ];

        return $resultados[$this->resultado_teste] ?? $this->resultado_teste;
    }

    public function getNotaTesteFormatadaAttribute()
    {
        return number_format($this->nota_teste, 1, ',', '.');
    }

    public function getPodeSubmeterAttribute()
    {
        return $this->status === 'pendente' &&
               $this->documentos_completos &&
               $this->taxa_paga;
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($inscricao) {
            if (empty($inscricao->data_inscricao)) {
                $inscricao->data_inscricao = now();
            }
        });

        static::created(function ($inscricao) {
            // Criar processo automático se não existir
            if (!$inscricao->processo_id) {
                $processo = Processo::create([
                    'aluno_id' => $inscricao->aluno_id,
                    'tipo' => 'admissao',
                    'descricao' => 'Processo de inscrição #' . $inscricao->id,
                    'criado_por' => $inscricao->aluno->usuario_id
                ]);

                $inscricao->processo_id = $processo->id;
                $inscricao->save();
            }
        });
    }
}
