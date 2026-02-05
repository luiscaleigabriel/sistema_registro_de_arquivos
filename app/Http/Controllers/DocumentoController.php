<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento;
use App\Models\Processo;
use App\Models\Inscricao;
use App\Models\Aluno;

class DocumentoController extends Controller
{
    /**
     * Listar documentos do aluno
     */
    public function alunoIndex()
    {
        $aluno = Auth::user()->aluno;

        // Documentos dos processos do aluno
        $documentos = Documento::whereHas('processo', function($query) use ($aluno) {
                $query->where('aluno_id', $aluno->id);
            })
            ->with(['processo', 'remetente'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('aluno.documentos.index', compact('documentos', 'aluno'));
    }

    /**
     * Formulário para enviar documento
     */
    public function create()
    {
        $aluno = Auth::user()->aluno;

        // Processos abertos do aluno para vincular documento
        $processos = Processo::where('aluno_id', $aluno->id)
            ->whereIn('status', ['aberto', 'em_analise'])
            ->get();

        // Inscrições pendentes do aluno
        $inscricoes = Inscricao::where('aluno_id', $aluno->id)
            ->whereIn('status', ['pendente', 'em_analise'])
            ->get();

        // Tipos de documentos
        $tiposDocumentos = [
            'bi' => 'Bilhete de Identidade',
            'certificado' => 'Certificado de Habilitações',
            'fotografia' => 'Fotografia 3x4',
            'comprovativo' => 'Comprovativo de Residência',
            'declaracao' => 'Declaração',
            'outro' => 'Outro Documento'
        ];

        return view('aluno.documentos.create', compact('aluno', 'processos', 'inscricoes', 'tiposDocumentos'));
    }

    /**
     * Armazenar novo documento
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'processo_id' => 'nullable|exists:processos,id',
            'inscricao_id' => 'nullable|exists:inscricoes,id',
            'documento' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'descricao' => 'nullable|string|max:255'
        ]);

        $aluno = Auth::user()->aluno;

        // Verificar se o processo pertence ao aluno
        if ($request->processo_id) {
            $processo = Processo::where('aluno_id', $aluno->id)
                ->findOrFail($request->processo_id);
        } else {
            $processo = null;
        }

        // Verificar se a inscrição pertence ao aluno
        if ($request->inscricao_id) {
            $inscricao = Inscricao::where('aluno_id', $aluno->id)
                ->findOrFail($request->inscricao_id);
        } else {
            $inscricao = null;
        }

        $file = $request->file('documento');

        // Definir caminho do arquivo
        if ($processo) {
            $path = 'documentos/alunos/' . $aluno->numero_aluno . '/' . $processo->num_processo;
        } elseif ($inscricao) {
            $path = 'documentos/inscricoes/' . $inscricao->id;
        } else {
            $path = 'documentos/alunos/' . $aluno->numero_aluno . '/geral';
        }

        $filename = $request->tipo . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = Storage::putFileAs($path, $file, $filename);

        // Criar documento
        $documento = Documento::create([
            'processo_id' => $request->processo_id,
            'inscricao_id' => $request->inscricao_id,
            'tipo' => $request->tipo,
            'nome_arquivo' => $filename,
            'caminho_arquivo' => $filePath,
            'extensao' => $file->getClientOriginalExtension(),
            'tamanho' => $file->getSize() / 1024, // KB
            'enviado_por' => Auth::id(),
            'data_envio' => now()
        ]);

        // Atualizar status da inscrição se documentos estiverem completos
        if ($inscricao) {
            $this->verificarDocumentosInscricao($inscricao);
        }

        return redirect()->route('aluno.documentos')
            ->with('success', 'Documento enviado com sucesso!');
    }

    /**
     * Verificar se todos os documentos da inscrição foram enviados
     */
    private function verificarDocumentosInscricao($inscricao)
    {
        $documentosObrigatorios = ['bi', 'certificado', 'fotografia'];
        $documentosEnviados = $inscricao->documentos()->pluck('tipo')->toArray();

        $completos = true;
        foreach ($documentosObrigatorios as $doc) {
            if (!in_array($doc, $documentosEnviados)) {
                $completos = false;
                break;
            }
        }

        if ($completos) {
            $inscricao->documentos_completos = true;
            $inscricao->save();
        }
    }

    /**
     * Download de documento
     */
    public function download($id)
    {
        $aluno = Auth::user()->aluno;
        $documento = Documento::whereHas('processo', function($query) use ($aluno) {
                $query->where('aluno_id', $aluno->id);
            })
            ->orWhereHas('inscricao', function($query) use ($aluno) {
                $query->where('aluno_id', $aluno->id);
            })
            ->findOrFail($id);

        if (!Storage::exists($documento->caminho_arquivo)) {
            return redirect()->back()->with('error', 'Arquivo não encontrado.');
        }

        return Storage::download($documento->caminho_arquivo, $documento->nome_arquivo);
    }

    /**
     * Excluir documento
     */
    public function destroy($id)
    {
        $aluno = Auth::user()->aluno;
        $documento = Documento::whereHas('processo', function($query) use ($aluno) {
                $query->where('aluno_id', $aluno->id);
            })
            ->findOrFail($id);

        // Verificar se pode excluir (apenas se status for pendente)
        if ($documento->status !== 'pendente') {
            return redirect()->back()->with('error', 'Não é possível excluir um documento já validado.');
        }

        // Excluir arquivo físico
        if (Storage::exists($documento->caminho_arquivo)) {
            Storage::delete($documento->caminho_arquivo);
        }

        $documento->delete();

        return redirect()->back()->with('success', 'Documento excluído com sucesso.');
    }
}
