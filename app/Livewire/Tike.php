<?php

namespace App\Livewire;

use App\Models\Resgistro;
use Livewire\Component;

class Tike extends Component
{
    public $registro;

    public function mount(Resgistro $registro)
    {
        $this->registro = $registro;
    }
    public function render()
    {
        return view('livewire.tike');
    }
}
