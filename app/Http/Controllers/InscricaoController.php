<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inscricao;
use App\Models\Aluno;
use App\Models\Processo;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;

class InscricaoController extends Controller
{
    /**
     * Listar inscrições do aluno
     */
    public function alunoIndex()
    {
        $aluno = Auth::user()->aluno;
        $inscricoes = Inscricao::where('aluno_id', $aluno->id)
            ->with('processo')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('aluno.inscricoes.index', compact('inscricoes', 'aluno'));
    }

    /**
     * Ver detalhes de uma inscrição
     */
    public function alunoShow($id)
    {
        $aluno = Auth::user()->aluno;
        $inscricao = Inscricao::where('aluno_id', $aluno->id)
            ->with(['processo', 'documentos', 'avaliador'])
            ->findOrFail($id);

        return view('aluno.inscricoes.show', compact('inscricao'));
    }

    /**
     * Formulário de nova inscrição
     */
    public function create()
    {
        $aluno = Auth::user()->aluno;

        // Tipos de cursos disponíveis
        $cursos = [
            'Informática',
            'Gestão',
            'Contabilidade',
            'Secretariado',
            'Eletricidade',
            'Mecânica',
            'Construção Civil'
        ];

        return view('aluno.inscricoes.create', compact('aluno', 'cursos'));
    }

    /**
     * Armazenar nova inscrição
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_inscricao' => 'required|in:regular,reinscricao,transferencia',
            'curso' => 'required|string',
            'ano_letivo' => 'required|string',
            'documentos' => 'array',
            'documentos.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120'
        ]);

        $aluno = Auth::user()->aluno;

        // Criar inscrição
        $inscricao = Inscricao::create([
            'aluno_id' => $aluno->id,
            'tipo_inscricao' => $request->tipo_inscricao,
            'status' => 'pendente',
            'data_inscricao' => now(),
            'documentos_completos' => $request->hasFile('documentos'),
            'taxa_paga' => false // Será atualizado após pagamento
        ]);

        // Atualizar aluno se for novo curso
        if ($request->tipo_inscricao == 'regular') {
            $aluno->update([
                'curso' => $request->curso,
                'ano_letivo' => $request->ano_letivo
            ]);
        }

        // Criar processo vinculado
        $processo = Processo::create([
            'aluno_id' => $aluno->id,
            'tipo' => 'admissao',
            'descricao' => 'Processo de ' . ($request->tipo_inscricao == 'regular' ? 'admissão' : $request->tipo_inscricao),
            'status' => 'aberto',
            'criado_por' => Auth::id(),
            'taxa_processo' => $request->tipo_inscricao == 'regular' ? 10000.00 : 5000.00
        ]);

        $inscricao->processo_id = $processo->id;
        $inscricao->save();

        // Upload de documentos
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $key => $documento) {
                $this->uploadDocumento($inscricao, $documento, $request->tipo_documentos[$key] ?? 'outro');
            }
        }

        return redirect()->route('aluno.inscricoes')
            ->with('success', 'Inscrição realizada com sucesso!');
    }

    /**
     * Upload de documento para inscrição
     */
    private function uploadDocumento($inscricao, $file, $tipo)
    {
        $aluno = Auth::user()->aluno;

        $path = 'documentos/inscricoes/' . $inscricao->id;
        $filename = $tipo . '_' . time() . '.' . $file->getClientOriginalExtension();

        $filePath = Storage::putFileAs($path, $file, $filename);

        Documento::create([
            'inscricao_id' => $inscricao->id,
            'processo_id' => $inscricao->processo_id,
            'tipo' => $tipo,
            'nome_arquivo' => $filename,
            'caminho_arquivo' => $filePath,
            'extensao' => $file->getClientOriginalExtension(),
            'tamanho' => $file->getSize() / 1024,
            'enviado_por' => Auth::id(),
            'data_envio' => now()
        ]);
    }

    /**
     * Fazer teste de admissão (simulação)
     */
    public function fazerTeste(Request $request, $id)
    {
        $request->validate([
            'nota' => 'required|numeric|min:0|max:20'
        ]);

        $aluno = Auth::user()->aluno;
        $inscricao = Inscricao::where('aluno_id', $aluno->id)->findOrFail($id);

        $inscricao->fazerTeste($request->nota);

        return redirect()->back()->with('success', 'Teste realizado! Nota: ' . $request->nota);
    }

    /**
     * Validar inscrição (aluno)
     */
    public function validar($id)
    {
        $aluno = Auth::user()->aluno;
        $inscricao = Inscricao::where('aluno_id', $aluno->id)->findOrFail($id);

        if ($inscricao->validar()) {
            return redirect()->back()->with('success', 'Inscrição validada e enviada para análise!');
        }

        return redirect()->back()->with('error', 'Inscrição não pode ser validada. Verifique se todos os documentos foram enviados.');
    }

    public function adicionarDocumento(Request $request, $id)
    {
        $aluno = Auth::user()->aluno;
        $inscricao = Inscricao::where('aluno_id', $aluno->id)->findOrFail($id);

        if ($inscricao->status !== 'pendente') {
            return redirect()->back()
                ->with('error', 'Só é possível adicionar documentos a inscrições pendentes.');
        }

        $request->validate([
            'tipo' => 'required|string|max:50',
            'documento' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120'
        ]);

        $this->uploadDocumento($inscricao, $request->file('documento'), $request->tipo);

        return redirect()->back()
            ->with('success', 'Documento adicionado com sucesso!');
    }

    public function destroyDocumento($id)
    {
        $aluno = Auth::user()->aluno;
        $documento = Documento::whereHas('inscricao', function ($query) use ($aluno) {
            $query->where('aluno_id', $aluno->id);
        })->findOrFail($id);

        if ($documento->inscricao->status !== 'pendente') {
            return redirect()->back()
                ->with('error', 'Não é possível excluir documentos de inscrições já enviadas.');
        }

        // Excluir arquivo físico
        Storage::delete($documento->caminho_arquivo);

        // Excluir registro
        $documento->delete();

        return redirect()->back()
            ->with('success', 'Documento excluído com sucesso!');
    }
}
