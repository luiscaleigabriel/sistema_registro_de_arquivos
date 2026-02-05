@extends('layouts.system')

@section('title', 'Meu Perfil')

@section('page-title', 'Meu Perfil')

@section('sidebar-menu')
@include('aluno.partials.menu')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Profile Card -->
            <div class="dashboard-card">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 100px; height: 100px;">
                        <i class="bi bi-person display-4"></i>
                    </div>
                    <h4 class="mb-1">{{ $user->nome }}</h4>
                    <p class="text-muted mb-0">{{ $aluno->numero_aluno }}</p>
                    <span class="badge bg-info mt-2">Aluno</span>
                </div>

                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Email</span>
                        <span class="fw-bold">{{ $user->email }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Telefone</span>
                        <span class="fw-bold">{{ $user->telefone }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>BI</span>
                        <span class="fw-bold">{{ $user->bi }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Data Nascimento</span>
                        <span class="fw-bold">{{ date('d/m/Y', strtotime($user->data_nasc)) }}</span>
                    </div>
                    <div class="list-group-item">
                        <span class="d-block mb-1">Morada</span>
                        <span class="fw-bold">{{ $user->morada }}</span>
                    </div>
                </div>
            </div>

            <!-- Student Info Card -->
            <div class="dashboard-card mt-4">
                <h5 class="mb-4">Informações Acadêmicas</h5>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Número Aluno</span>
                        <span class="fw-bold">{{ $aluno->numero_aluno }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Curso</span>
                        <span class="fw-bold">{{ $aluno->curso }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Ano Letivo</span>
                        <span class="fw-bold">{{ $aluno->ano_letivo }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Status</span>
                        <span class="badge bg-success">{{ ucfirst($aluno->status) }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Data Inscrição</span>
                        <span class="fw-bold">{{ date('d/m/Y', strtotime($aluno->data_inscricao)) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Edit Profile Form -->
            <div class="dashboard-card">
                <h5 class="mb-4">Editar Perfil</h5>

                <form method="POST" action="{{ route('aluno.perfil.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome Completo *</label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                   value="{{ old('nome', $user->nome) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone *</label>
                            <input type="text" class="form-control" id="telefone" name="telefone"
                                   value="{{ old('telefone', $user->telefone) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="bi" class="form-label">Bilhete de Identidade</label>
                            <input type="text" class="form-control" id="bi" value="{{ $user->bi }}" disabled>
                            <small class="text-muted">O BI não pode ser alterado.</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="data_nasc" class="form-label">Data de Nascimento</label>
                            <input type="text" class="form-control" id="data_nasc"
                                   value="{{ date('d/m/Y', strtotime($user->data_nasc)) }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="curso" class="form-label">Curso</label>
                            <input type="text" class="form-control" id="curso" value="{{ $aluno->curso }}" disabled>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="morada" class="form-label">Morada *</label>
                            <textarea class="form-control" id="morada" name="morada" rows="3" required>{{ old('morada', $user->morada) }}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3">Alterar Senha</h6>
                    <p class="text-muted mb-4">Deixe em branco se não quiser alterar a senha.</p>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="senha_atual" class="form-label">Senha Atual</label>
                            <input type="password" class="form-control" id="senha_atual" name="senha_atual">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nova_senha" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="nova_senha" name="nova_senha">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nova_senha_confirmation" class="form-label">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="nova_senha_confirmation" name="nova_senha_confirmation">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Atualizar Perfil
                        </button>
                    </div>
                </form>
            </div>

            <!-- Activity Stats -->
            <div class="dashboard-card mt-4">
                <h5 class="mb-4">Estatísticas de Atividade</h5>
                <div class="row">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="text-center p-3 border rounded">
                            <h3 class="text-primary mb-1">{{ $aluno->processos->count() }}</h3>
                            <p class="text-muted mb-0">Processos</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="text-center p-3 border rounded">
                            <h3 class="text-success mb-1">{{ $aluno->inscricoes->count() }}</h3>
                            <p class="text-muted mb-0">Inscrições</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="text-center p-3 border rounded">
                            @php
                                $docCount = $aluno->documentos->count();
                            @endphp
                            <h3 class="text-warning mb-1">{{ $docCount }}</h3>
                            <p class="text-muted mb-0">Documentos</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="text-center p-3 border rounded">
                            <h3 class="text-info mb-1">{{ $aluno->created_at->format('d/m/Y') }}</h3>
                            <p class="text-muted mb-0">Membro desde</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
