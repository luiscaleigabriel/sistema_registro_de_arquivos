<?php

use Livewire\Component;

new class extends Component
{
    public $name;
    public $data_nasc = '07/02/2004';
    public $bi;
    public $phone;
    public $morada;
    public $photo;

    public $rules = [
        'name' => 'required',
        'data_nasc' => 'required',
        'bi' => 'required',
        'phone' => 'required',
        'morada' => 'required',
    ];

    public function updateProfile()
    {
        $this->validate();

        // return dd([$this->name, $this->data_nasc, $this->bi, $this->morada, $this->photo, $this->phone]);
    }

};
