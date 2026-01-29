<?php

namespace App\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    use WithPagination;

    public $content;

    public function render()
    {
        $tweets = Tweet::with('user')->paginate(10);

        return view('livewire.show-tweets', compact('tweets'));
    }

    public function create()
    {
        $this->validate([
            'content' => 'required|min:3|max:255'
        ],[
            'required' => 'O campo conteúdo é obrigatório!',
            'min' => 'O Tweet deve ter mais de 3 caracteres!',
            'max' => 'O limite de caracteres permitido é 255!',
        ]);

        Tweet::create([
            'content' => $this->content,
            'user_id' => 6,
        ]);

        $this->content = '';
    }
}
