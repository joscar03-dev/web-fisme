<?php

use App\Filament\Resources\AsistenciaResource\Pages\EscanearAsistenciaPage;
use App\Filament\Resources\ResgistroResource\Pages\TicketQrPage;
use App\Livewire\Agenda;
use App\Livewire\Contact;
use App\Livewire\Evento;
use App\Livewire\Eventos;
use App\Livewire\FelicitacionRegistro;
use App\Livewire\HomePage;
use App\Livewire\InscripcionConcursos;
use App\Livewire\Inscripciones;
use App\Livewire\LectorAsistencias;
use App\Livewire\Organizadores;
use App\Livewire\Registrarse;
use App\Livewire\SubirDocumentos;
use App\Mail\PruebaMailable;
use App\Models\Resgistro;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomePage::class)->name('home');
Route::get('/evento/{slug}', Evento::class)->name('evento.detalle');
Route::get('/agenda', Agenda::class)->name('agenda');
Route::get('/organizadores', Organizadores::class)->name('organizadores');
Route::get('/contact', Contact::class)->name('contacto');


// Inscribirce
Route::get('/inscripcion', Inscripciones::class)->name('inscripcion');
Route::get('/event-registration/{slug}', Registrarse::class)->name('event.registration');
Route::get('/felicitacion-inscripcion/{evento}/{nombre}', FelicitacionRegistro::class)->name('felicitacion-inscripcion');

Route::get('/confirmacion-inscripcion/{modelo}/{slug}/{nombre}', FelicitacionRegistro::class)->name('confirmacion-inscripcion');
// Politicas
Route::get('/cookies/policy', function () {
    return view('cookies.policy');
})->name('cookies.policy');

Route::get('/cookies/manage', function () {
    return view('cookies.manage');
})->name('cookies.manage');

//filament
Route::post('/admin/asistencias/escanear', [EscanearAsistenciaPage::class, 'registerAsistencia'])->name('filament.admin.resources.asistencias.escanear.register');

Route::post('/enviar-correo/{registro}', [TicketQrPage::class, 'enviarCorreo'])->name('enviarCorreo');


// mantenimiento 
Route::view('/pagina-mantenimiento', 'components.mantenimiento')->name('mantenimiento');

Route::get('/inscripcion-concursos/{slug}', InscripcionConcursos::class)->name('inscripcion-concursos');
Route::get('/inscripcion-concursos/{inscripcion_concurso_id}/subir-documentos', SubirDocumentos::class)->name('subir-documentos');