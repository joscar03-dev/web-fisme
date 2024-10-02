<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Precio;
use App\Models\Resgistro;
use Livewire\Component;
use Livewire\WithFileUploads;

class Inscripciones extends Component
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
    public $tipo;  // Venta normal o preventa
    public $precio;  // Precio basado en el tipo de asistente
    public $eventos;

    // Reglas de validación
    protected $rules = [
        'tipo_documento' => 'required',
        'numero_documento' => 'required|min:8|max:15',
        'nombres' => 'required|min:2',
        'apellidos' => 'required|min:2',
        'numero_celular' => 'required|min:9|max:20',
        'email' => 'required|email',
        'img_boucher' => 'required|image|max:1024', // max 1MB
        'evento_id' => 'required|exists:eventos,id',
        'tipo_asistente' => 'required|string',
        'institucion_procedencia' => 'required|min:2',
        'modalidad' => 'required|string',
        'entidad_financiera' => 'required|string',
        'tipo' => 'required|string', // preventa o venta normal
    ];

    // Método para cargar los eventos activos cuando el componente es montado
    public function mount()
    {
        $this->eventos = Evento::where('estado', true)->get();
    }


    // Método que se ejecuta cuando el tipo de asistente cambia
    public function updatedTipoAsistente($value)
    {
        $this->precio = Precio::where('tipo_asistente', $value)->value('precio');
    }

    // Método para procesar el registro
    public function register()
    {
        
        // Validar los datos
        $this->validate();

        // Guardar la imagen del boucher
        $imagePath = $this->img_boucher->store('registro', 'public');
     
        // Crear el registro en la base de datos
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
            'modalidad' => $this->modalidad,
            'entidad_financiera' => $this->entidad_financiera,
            'tipo' => $this->tipo,  // Venta normal o preventa
            'monto' => $this->precio,  // El precio va al campo 'monto'
        ]);


        // Limpiar los campos después de guardar
        $this->reset([
            'tipo_documento',
            'numero_documento',
            'nombres',
            'apellidos',
            'numero_celular',
            'email',
            'img_boucher',
            'evento_id',
            'tipo_asistente',
            'institucion_procedencia',
            'modalidad',
            'entidad_financiera',
            'tipo',
            'precio',
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', '¡Registro exitoso! Tu inscripción está siendo procesada.');
    }
    public function render()
    {
        return view('livewire.inscripciones');
    }
}
