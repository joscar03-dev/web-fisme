<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;

class HomePage extends Component
{
    public $searchTerm = '';
    public $events;
    public $currentSlide = 0;
    public $slides;

    public function mount()
    {
        $this->events = Evento::upcoming()->take(3)->get();
        $this->slides = Evento::featured()->get();
    }

    public function search()
    {
        // Implementar lógica de búsqueda
    }

    public function nextSlide()
    {
        $this->currentSlide = ($this->currentSlide + 1) % count($this->slides);
    }

    public function prevSlide()
    {
        $this->currentSlide = ($this->currentSlide - 1 + count($this->slides)) % count($this->slides);
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
