<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Processo extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'processos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'aluno_id',
        'num_processo',
        'data_abertura',
        'tipo',
        'status',
        'descricao',
        'taxa_processo',
        'criado_por',
        'analisado_por',
        'data_analise',
        'observacoes_analise',
        'data_arquivamento',
        'local_arquivamento'
    ];

    protected $casts = [
        'data_abertura' => 'date:d/m/Y',
        'data_analise' => 'date:d/m/Y',
        'data_arquivamento' => 'date:d/m/Y',
        'taxa_processo' => 'decimal:2',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];

    // Relacionamentos
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function criador()
    {
        return $this->belongsTo(Usuario::class, 'criado_por');
    }

    public function analista()
    {
        return $this->belongsTo(Usuario::class, 'analisado_por');
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'processo_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'processo_id');
    }

    // Scopes
    public function scopeAbertos($query)
    {
        return $query->where('status', 'aberto');
    }

    public function scopeEmAnalise($query)
    {
        return $query->where('status', 'em_analise');
    }

    public function scopeAprovados($query)
    {
        return $query->where('status', 'aprovado');
    }

    public function scopeArquivados($query)
    {
        return $query->where('status', 'arquivado');
    }

    public function scopePorAluno($query, $alunoId)
    {
        return $query->where('aluno_id', $alunoId);
    }

    public function scopePorNumero($query, $numero)
    {
        return $query->where('num_processo', 'like', "%{$numero}%");
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    // Métodos
    public function abrirProcesso()
    {
        $this->status = 'aberto';
        $this->save();
    }

    public function fecharProcesso()
    {
        $this->status = 'arquivado';
        $this->data_arquivamento = now();
        $this->save();
    }

    public function iniciarAnalise($analistaId)
    {
        $this->status = 'em_analise';
        $this->analisado_por = $analistaId;
        $this->data_analise = now();
        $this->save();
    }

    public function aprovarProcesso($observacoes = null)
    {
        $this->status = 'aprovado';
        $this->observacoes_analise = $observacoes;
        $this->save();
    }

    public function rejeitarProcesso($observacoes = null)
    {
        $this->status = 'rejeitado';
        $this->observacoes_analise = $observacoes;
        $this->save();
    }

    public function podeSerArquivado()
    {
        return in_array($this->status, ['aprovado', 'rejeitado']);
    }

    public function adicionarDocumento($documentoData)
    {
        return $this->documentos()->create($documentoData);
    }

    // Acessors
    public function getStatusFormatadoAttribute()
    {
        $statuses = [
            'aberto' => 'Aberto',
            'em_analise' => 'Em Análise',
            'aprovado' => 'Aprovado',
            'rejeitado' => 'Rejeitado',
            'arquivado' => 'Arquivado'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getTipoFormatadoAttribute()
    {
        $tipos = [
            'admissao' => 'Admissão',
            'matricula' => 'Matrícula',
            'transferencia' => 'Transferência',
            'outro' => 'Outro'
        ];

        return $tipos[$this->tipo] ?? $this->tipo;
    }

    public function getTaxaProcessoFormatadaAttribute()
    {
        return number_format($this->taxa_processo, 2, ',', '.') . ' Kz';
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($processo) {
            if (empty($processo->num_processo)) {
                $processo->num_processo = self::gerarNumeroProcesso();
            }
            if (empty($processo->data_abertura)) {
                $processo->data_abertura = now();
            }
        });

        static::created(function ($processo) {
            // Criar atividade no log
            activity()
                ->performedOn($processo)
                ->causedBy(auth()->user())
                ->log('Processo criado: ' . $processo->num_processo);
        });
    }

    // Método estático para gerar número de processo
    public static function gerarNumeroProcesso()
    {
        $ano = date('Y');
        $mes = date('m');
        $sequencia = self::whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->count() + 1;

        return 'PROC/' . $ano . '/' . $mes . '/' . str_pad($sequencia, 4, '0', STR_PAD_LEFT);
    }
}
