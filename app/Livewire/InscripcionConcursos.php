<?php

namespace App\Livewire;

use App\Models\Concurso;
use App\Models\DocumentosInscripcion;
use App\Models\InscripcionConcurso;
use App\Models\TipoDocumento;
use Livewire\Component;
use Livewire\WithFileUploads;

class InscripcionConcursos extends Component
{
    use WithFileUploads;

    public $slug;
    public $tipo_documento;
    public $numero_documento;
    public $nombres = '';
    public $apellidos = '';
    public $numero_celular;
    public $tipo_participante;
    public $institucion_procedencia;
    public $email;
    public $img_boucher;
    public $concurso_id;
    public $concurso;
    public $documentos = [];
    public $tipos_documentos = [];
    public $inscripcion_id;
    public $mostrarSubirDocumentos = false;

    public function mount($slug)
    {
        $this->concurso = Concurso::where('slug', $slug)->firstOrFail();
        $this->concurso_id = $this->concurso->id;
        $this->tipos_documentos = TipoDocumento::take(3)->get();
    }

    public function submit()
    {
        // Validar solo los campos de inscripción y documentos
        $this->validate([
            'tipo_documento' => 'required|string|max:255',
            'numero_documento' => 'required|string|max:255|unique:inscripcion_concursos,numero_documento',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'numero_celular' => 'required|string|max:15',
            'tipo_participante' => 'required|string',
            'institucion_procedencia' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'img_boucher' => 'required|image|max:2048',
            'documentos.*' => 'required|file|max:2048',
        ], [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.unique' => 'El número de documento ya ha sido registrado.',
            'nombres.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'El apellido es obligatorio.',
            'numero_celular.required' => 'El número de celular es obligatorio.',
            'tipo_participante.required' => 'El tipo de participante es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'img_boucher.required' => 'Debe subir el boucher de pago.',
            'img_boucher.image' => 'El archivo debe ser una imagen.',
            'img_boucher.max' => 'La imagen no debe superar los 2MB.',
            'documentos.*.required' => 'Todos los documentos son obligatorios.',
            'documentos.*.file' => 'Debe subir un archivo válido.',
            'documentos.*.max' => 'Cada documento no debe superar los 2MB.',
        ]);

        // Almacenar el boucher
        $boucherPath = $this->img_boucher->store('bouchers_concursos', 'public');

        // Crear la inscripción
        $inscripcion = InscripcionConcurso::create([
            'concurso_id' => $this->concurso_id,
            'tipo_documento' => $this->tipo_documento,
            'numero_documento' => $this->numero_documento,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'numero_celular' => $this->numero_celular,
            'tipo_participante' => $this->tipo_participante,
            'institucion_procedencia' => $this->institucion_procedencia,
            'email' => $this->email,
            'img_boucher' => $boucherPath,
            'fecha_registro' => now(),
            'estado' => 1,
        ]);

        // Obtener el id de la inscripción
        $this->inscripcion_id = $inscripcion->id;

        // Subir y guardar los documentos
        foreach ($this->tipos_documentos as $index => $tipo_documento) {
            if (isset($this->documentos[$index])) {
                $path = $this->documentos[$index]->store('documentos_inscripciones', 'public');

                DocumentosInscripcion::create([
                    'inscripcion_concurso_id' => $this->inscripcion_id,
                    'tipo_documento_id' => $tipo_documento->id,
                    'ruta' => $path,
                ]);
            }
        }

        // Mostrar mensaje de éxito
        session()->flash('message', 'Inscripción y subida de documentos realizada exitosamente.');

        $nombreCompleto = trim($this->nombres) . ' ' . trim($this->apellidos);

        if (empty($nombreCompleto) || $nombreCompleto === ' ') {
            $nombreCompleto = 'Participante';
        }
        // Resetear el formulario
        $this->resetForm();
        return redirect()->route('confirmacion-inscripcion', [
            'modelo' => $this->concurso_id ? 'concurso' : 'evento',
            'slug' => $this->concurso->slug,
            'nombre' => $nombreCompleto,
        ]);
    }

    private function resetForm()
    {
        $this->tipo_documento = '';
        $this->numero_documento = '';
        $this->nombres = '';
        $this->apellidos = '';
        $this->numero_celular = '';
        $this->tipo_participante = '';
        $this->institucion_procedencia = '';
        $this->email = '';
        $this->img_boucher = null;
        $this->documentos = [];
    }

    public function render()
    {
        return view('livewire.inscripcion-concursos');
    }
}
