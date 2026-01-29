<div>
    <h2 class="mt-4">Novo Tweet</h2>
    <hr>

    <form wire:submit.prevent='create' method="POST" >
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Conteudo</label>
            <input wire:model='content' type="text" class="form-control" name="content" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('content')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Criar Tweet</button>
    </form>
    <hr>
    <h2 class="mt-4">Todos Tweets</h2>
    <table class="table table-striped">
        <thead>
            <th>Usuário</th>
            <th>Tweet</th>
            <th>Ação</th>
        </thead>
        <tbody>
            @forelse ($tweets as $tweet)
                <tr>
                    <td>{{ $tweet->user->name }}</td>
                    <td>{{ $tweet->content }}</td>
                    <td>
                        n
                    </td>
                </tr>
            @empty
                <td colspan="3" class="text-danger">Nenhum tweet encontrado!</td>
            @endforelse
        </tbody>
    </table>
    {{ $tweets->links() }}

    <br>
    <br>
    <br>
</div>
