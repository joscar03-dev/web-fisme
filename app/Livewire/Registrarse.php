<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Resgistro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
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
    public $tipo_asistente;
    public $institucion_procedencia;
    public $modalidad;
    public $entidad_financiera;
    public $fecha_pago;
    public $n_comprobante;
    public $tipo;

    public $evento;

    protected $rules = [
        'tipo_documento' => 'required|in:DNI,CE,Pasaporte',
        'numero_documento' => 'required|min:8|max:15',
        'nombres' => 'required|min:5',
        'apellidos' => 'required|min:5',
        'numero_celular' => 'required|min:9|max:20',
        'email' => 'required|email',
        'img_boucher' => 'required|image|max:2048', // max 2MB
        'institucion_procedencia' => 'required|min:2',
        'tipo' => 'required|string',
        'modalidad' => 'required|string',
        'entidad_financiera' => 'required|string',
    ];

    public function mount($slug)
    {
        $this->evento = Evento::where('slug', $slug)->firstOrFail();
        $this->evento_id = $this->evento->id;
        $this->tipo_asistente = request()->query('tipo_asistente');
    }

    public function register()
    {
        $this->validate();

        try {
            $imagePath = $this->img_boucher->store('registro', 'public');

            Resgistro::create([
                'tipo_documento' => $this->tipo_documento,
                'numero_documento' => $this->numero_documento,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'numero_celular' => $this->numero_celular,
                'email' => $this->email,
                'img_boucher' => $imagePath,
                'evento_id' => $this->evento_id,
                'tipo_asistente' => $this->tipo_asistente,
                'institucion_procedencia' => $this->institucion_procedencia,
                'tipo' => $this->tipo,
                'modalidad' => $this->modalidad,
                'entidad_financiera' => $this->entidad_financiera,
                'fecha_pago' => Carbon::parse($this->fecha_pago),
                'n_comprobante' => $this->n_comprobante,
            ]);

            $this->reset(['tipo_documento', 'numero_documento', 'nombres', 'apellidos', 'numero_celular', 'email', 'img_boucher', 'institucion_procedencia']);
            session()->flash('message', 'Su registro se ha realizado con éxito');

        } catch (\Exception $e) {
            session()->flash('error', 'Hubo un error al procesar su registro. Por favor, inténtelo de nuevo.');
        }
    }

    public function render()
    {
        return view('livewire.registrarse');
    }

}
