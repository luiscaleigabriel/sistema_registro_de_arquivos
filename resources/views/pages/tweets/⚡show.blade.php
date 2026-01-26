<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tweet;

new class extends Component
{
    use WithPagination;

    public string $content;
    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    public function todos()
    {
        return Tweet::with('user')->paginate(2);
    }

    public function create()
    {

        $this->validate();

        Tweet::create([
            'content' => $this->content,
            'user_id' => 10,
        ]);

        $this->content = '';
    }

};
?>

<div>

    <h1>Formulário</h1>
    <form wire:submit.prevent="create" method="post">
        <input wire:model="content" type="text" name="content" id="content">
        @error('content') {{ $message }} @enderror
        <button type="submit">Criar Tweet</button>
    </form>

    <br>
    <hr>

    <h1>Lista de tweets</h1>

    @forelse ($this->todos() as $tweet)
        <p>{{ $tweet->user->name }} - {{ $tweet->content }}</p>
    @empty
        <p>Nenhum tweet encontrado</p>
    @endforelse

    <hr>
    <div>
        {{ $this->todos()->links() }}
    </div>

</div>
