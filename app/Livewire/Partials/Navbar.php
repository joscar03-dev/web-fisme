<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{
    public $activeLink = 'home';

    public function setActiveLink($link)
    {
        $this->activeLink = $link;
    }

    public function navigateTo($route)
    {
        $this->activeLink = $route;
        
        // Usar dispatch en lugar de dispatchBrowserEvent
        $this->dispatch('show-loading-screen');

        // Simular una carga de 1 segundo
        sleep(1);

        // Redirigir a la ruta correspondiente
        return redirect()->to($route === 'home' ? route('home') : ($route === 'contacto' ? route('contacto') : $route));
    }
    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
