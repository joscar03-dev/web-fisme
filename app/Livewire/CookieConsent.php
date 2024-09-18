<?php

namespace App\Livewire;

use Livewire\Component;

class CookieConsent extends Component
{
    public $isVisible = false;

    public function mount()
    {
        $this->isVisible = !session()->has('cookieConsent');
    }

    public function allowAll()
    {
        session(['cookieConsent' => 'all']);
        $this->isVisible = false;
        // Aquí puedes agregar lógica adicional para habilitar todas las cookies
    }

    public function rejectAll()
    {
        session(['cookieConsent' => 'none']);
        $this->isVisible = false;
        // Aquí puedes agregar lógica adicional para deshabilitar todas las cookies
    }

    public function manageCookies()
    {
        // Aquí puedes agregar lógica para abrir una página o modal de configuración de cookies
        // Por ejemplo, redirigir a una página de configuración de cookies
        return redirect()->route('cookies.manage');
    }

    public function dismiss()
    {
        $this->isVisible = false;
    }

    public function render()
    {
        return view('livewire.cookie-consent');
    }
}
