<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Processo;
use App\Models\Aluno;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;

class ProcessoController extends Controller
{
    /**
     * Listar processos do aluno
     */
    public function alunoIndex()
    {
        $aluno = Auth::user()->aluno;
        $processos = Processo::where('aluno_id', $aluno->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('aluno.processos.index', compact('processos', 'aluno'));
    }

    /**
     * Ver detalhes de um processo
     */
    public function alunoShow($id)
    {
        $aluno = Auth::user()->aluno;
        $processo = Processo::where('aluno_id', $aluno->id)
            ->with(['aluno.usuario', 'documentos'])
            ->findOrFail($id);

        return view('aluno.processos.show', compact('processo'));
    }

    /**
     * Criar novo processo
     */
    public function create()
    {
        $aluno = Auth::user()->aluno;
        return view('aluno.processos.create', compact('aluno'));
    }

    /**
     * Armazenar novo processo
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:admissao,matricula,transferencia,outro',
            'descricao' => 'required|string|max:500',
            'documentos' => 'array',
            'documentos.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120'
        ]);

        $aluno = Auth::user()->aluno;

        // Criar processo
        $processo = Processo::create([
            'aluno_id' => $aluno->id,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
            'status' => 'aberto',
            'criado_por' => Auth::id(),
            'taxa_processo' => 5000.00 // Valor padrão
        ]);

        // Upload de documentos
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $key => $documento) {
                $this->uploadDocumento($processo, $documento, $request->tipo_documentos[$key] ?? 'outro');
            }
        }

        return redirect()->route('aluno.processos')
            ->with('success', 'Processo criado com sucesso!');
    }

    /**
     * Upload de documento
     */
    private function uploadDocumento($processo, $file, $tipo)
    {
        $aluno = Auth::user()->aluno;

        $path = 'documentos/alunos/' . $aluno->numero_aluno . '/' . $processo->num_processo;
        $filename = $tipo . '_' . time() . '.' . $file->getClientOriginalExtension();

        $filePath = Storage::putFileAs($path, $file, $filename);

        Documento::create([
            'processo_id' => $processo->id,
            'tipo' => $tipo,
            'nome_arquivo' => $filename,
            'caminho_arquivo' => $filePath,
            'extensao' => $file->getClientOriginalExtension(),
            'tamanho' => $file->getSize() / 1024, // KB
            'enviado_por' => Auth::id(),
            'data_envio' => now()
        ]);
    }
}
