<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Resgistro;
use Livewire\Component;
use Livewire\WithFileUploads;

class Registrarse extends Component
{
    use WithFileUploads;

    public $tipo_documento;
    public $numero_documento;
    public $nombres;
    public $apellidos;
    public $numero_celular;
    public $email;
    public $img_boucher;
    public $evento_id;

    public $evento;

    protected $rules = [
        'tipo_documento' => 'required|in:DNI,CE,Pasaporte',
        'numero_documento' => 'required|min:8|max:15',
        'nombres' => 'required|min:2',
        'apellidos' => 'required|min:2',
        'numero_celular' => 'required|min:9|max:20',
        'email' => 'required|email',
        'img_boucher' => 'required|image|max:1024', // max 1MB
    ];

    public function mount($eventoId)
    {
        $this->evento_id = $eventoId;
        $this->evento = Evento::findOrFail($eventoId);
    }

    public function updatedImgBoucher()
    {
        $this->validate([
            'img_boucher' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function register()
    {
        $this->validate();

        $imagePath = $this->img_boucher->store('bouchers', 'public');

        Resgistro::create([
            'tipo_documento' => $this->tipo_documento,
            'numero_documento' => $this->numero_documento,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'numero_celular' => $this->numero_celular,
            'email' => $this->email,
            'img_boucher' => $imagePath,
            'evento_id' => $this->evento_id,
        ]);

        $this->reset(['tipo_documento', 'numero_documento', 'nombres', 'apellidos', 'numero_celular', 'email', 'img_boucher']);
        session()->flash('message', '¡Registro exitoso! Tu inscripción está siendo procesada.');
    }
    public function render()
    {
        return view('livewire.registrarse');
    }
}
