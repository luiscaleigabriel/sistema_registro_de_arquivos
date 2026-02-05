<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('aluno.dashboard') ? 'active' : '' }}"
           href="{{ route('aluno.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('aluno.processos*') ? 'active' : '' }}"
           href="{{ route('aluno.processos') }}">
            <i class="bi bi-folder"></i>
            <span>Meus Processos</span>
            @php
                $processosAbertos = Auth::user()->aluno->processos->where('status', 'aberto')->count();
            @endphp
            @if($processosAbertos > 0)
            <span class="badge bg-warning float-end">{{ $processosAbertos }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('aluno.inscricoes*') ? 'active' : '' }}"
           href="{{ route('aluno.inscricoes') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Minhas Inscrições</span>
            @php
                $inscricoesPendentes = Auth::user()->aluno->inscricoes->where('status', 'pendente')->count();
            @endphp
            @if($inscricoesPendentes > 0)
            <span class="badge bg-warning float-end">{{ $inscricoesPendentes }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('aluno.documentos*') ? 'active' : '' }}"
           href="{{ route('aluno.documentos') }}">
            <i class="bi bi-file-earmark-pdf"></i>
            <span>Meus Documentos</span>
            @php
                $documentosPendentes = Auth::user()->aluno->documentos->where('status', 'pendente')->count();
            @endphp
            @if($documentosPendentes > 0)
            <span class="badge bg-warning float-end">{{ $documentosPendentes }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('aluno.perfil*') ? 'active' : '' }}"
           href="{{ route('aluno.perfil') }}">
            <i class="bi bi-person"></i>
            <span>Meu Perfil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('aluno.nova-inscricao') ? 'active' : '' }}"
           href="{{ route('aluno.nova-inscricao') }}">
            <i class="bi bi-plus-circle"></i>
            <span>Nova Inscrição</span>
        </a>
    </li>
    <li class="nav-item mt-4">
        <hr class="mx-3">
        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sair</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
