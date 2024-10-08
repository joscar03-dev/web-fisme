<?php

namespace App\Livewire;

use App\Models\DocumentosInscripcion;
use App\Models\TipoDocumento;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubirDocumentos extends Component
{
    use WithFileUploads;

    public $inscripcion_concurso_id;
    public $documentos = []; 
    public $tipos_documentos = []; 

    public function mount($inscripcion_concurso_id)
    {
        $this->inscripcion_concurso_id = $inscripcion_concurso_id;

        $this->tipos_documentos = TipoDocumento::take(3)->get();
    }

    /* public function submit()
    {
        $this->validate([
            'documentos.*' => 'required|file|max:2048', // Validar archivos subidos
        ]);

        foreach ($this->tipos_documentos as $index => $tipo_documento) {
            if (isset($this->documentos[$index])) {
                // Subir archivo y guardar en la base de datos
                $path = $this->documentos[$index]->store('documentos_inscripciones', 'public');


                DocumentosInscripcion::create([
                    'inscripcion_concurso_id' => $this->inscripcion_concurso_id,
                    'tipo_documento_id' => $tipo_documento->id,
                    'ruta' => $path, // Ajustar el campo aquí según tu tabla
                ]);
            }
        }

        session()->flash('message', 'Documentos subidos correctamente.');
        $this->reset(['documentos']);
    } */

    public function submit()
    {
        try {
            $this->validate([
                'documentos.*' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xls,xlsx,ppt,pptx|max:20480',
            ]);

            foreach ($this->tipos_documentos as $index => $tipo_documento) {
                if (isset($this->documentos[$index])) {
                    $documentoExistente = DocumentosInscripcion::where('inscripcion_concurso_id', $this->inscripcion_concurso_id)
                        ->where('tipo_documento_id', $tipo_documento->id)
                        ->first();

                    $path = $this->documentos[$index]->store('documentos_inscripciones', 'public');

                    if ($documentoExistente) {
                        $documentoExistente->update([
                            'ruta' => $path, 
                        ]);
                    } else {
                        DocumentosInscripcion::create([
                            'inscripcion_concurso_id' => $this->inscripcion_concurso_id,
                            'tipo_documento_id' => $tipo_documento->id,
                            'ruta' => $path, // Guardar la ruta del archivo subido
                        ]);
                    }
                }
            }

            session()->flash('message', 'Documentos subidos correctamente.');
            $this->reset(['documentos']);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al subir los documentos: ' . $e->getMessage());
            dd($e);
        }
    }
    public function render()
    {
        return view('livewire.subir-documentos', [
            'tipos_documentos' => $this->tipos_documentos
        ]);
    }
}
