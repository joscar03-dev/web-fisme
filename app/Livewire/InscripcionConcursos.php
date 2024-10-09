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

    public $concurso_id;
    public $tipo_documento;
    public $numero_documento;
    public $nombres;
    public $apellidos;
    public $numero_celular;
    public $tipo_participante;
    public $institucion_procedencia;
    public $email;
    public $img_boucher;

    public $documentos = [];
    public $tipos_documentos = [];
    public $inscripcion_id;
    public $mostrarSubirDocumentos = false;

    public function mount($concurso_id)
    {
        $this->concurso_id = $concurso_id;
        $this->tipos_documentos = TipoDocumento::take(3)->get();
    }

    public function submit()
    {
        $inscripcion = InscripcionConcurso::where('numero_documento', $this->numero_documento)->first();

        if ($inscripcion) {
            $documentosSubidos = DocumentosInscripcion::where('inscripcion_concurso_id', $inscripcion->id)->exists();

            if ($documentosSubidos) {
                session()->flash('message', 'Ya has completado tu inscripción y has subido todos los documentos.');
                return;
            } else {
                return redirect()->route('subir-documentos', $inscripcion->id);
            }
        } else {
            $this->validate([
                'tipo_documento' => 'required|string|max:255',
                'numero_documento' => 'required|string|max:255|unique:inscripcion_concursos,numero_documento',
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'numero_celular' => 'required|string|max:15',
                'tipo_participante' => 'required|string',
                'institucion_procedencia' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'img_boucher' => 'required|image|max:2048', // Valida el boucher como imagen (max 2MB)
            ]);

            $boucherPath = $this->img_boucher->store('bouchers', 'public');

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


            $this->inscripcion_id = $inscripcion->id;

            // Subir documentos
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
    
            // Resetear formulario
            $this->resetForm();
        }

        // return redirect()->route('subir-documentos', $inscripcion->id);
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
