<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Resgistro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Registrarse extends Component
{
    use LivewireAlert;
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
        'numero_documento' => 'required|min:8|max:15|unique:registros,numero_documento',
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
    public function messages()
    {
        return [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.unique' => 'El número de documento ya ha sido registrado.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'numero_celular.required' => 'El número de celular es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ser una dirección de correo válida.',
            'img_boucher.required' => 'La imagen del boucher es obligatoria.',
            'img_boucher.image' => 'El archivo debe ser una imagen.',
            'institucion_procedencia.required' => 'La institución de procedencia es obligatoria.',
            'tipo.required' => 'El tipo es obligatorio.',
            'modalidad.required' => 'La modalidad es obligatoria.',
            'entidad_financiera.required' => 'La entidad financiera es obligatoria.',
        ];
    }
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

            $this->reset(['tipo_documento', 'numero_documento', 'nombres', 'apellidos', 'numero_celular', 'email', 'img_boucher', 'institucion_procedencia', 'tipo', 'modalidad', 'modalidad', 'fecha_pago', 'n_comprobante', 'entidad_financiera']);

            $this->alert(
                'success',
                'Su registro se ha realizado con éxito',
                [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                ]
            );
        } catch (\Exception $e) {
            $this->alert('error', 'Hubo un error al procesar su registro. Por favor, inténtelo de nuevo.',
            
            [
                'position' => 'bottom-end',
                'timer' => 3000,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.registrarse');
    }
}
