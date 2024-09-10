<?php

use App\Filament\Resources\AsistenciaResource\Pages\EscanearAsistenciaPage;
use App\Livewire\Agenda;
use App\Livewire\Contact;
use App\Livewire\Evento;
use App\Livewire\Eventos;
use App\Livewire\HomePage;
use App\Livewire\Inscripciones;
use App\Livewire\LectorAsistencias;
use App\Livewire\Organizadores;
use App\Livewire\Registrarse;
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
Route::get('/evento/{id}', Evento::class)->name('evento.detalle');
Route::get('/eventos', Eventos::class)->name('eventos');

Route::get('/agenda', Agenda::class)->name('agenda');
Route::get('/organizadores', Organizadores::class)->name('organizadores');
Route::get('/contact', Contact::class)->name('contacto');
// Route::get('/', HomePage::class);
Route::get('/inscripcion', Inscripciones::class)->name('inscripcion');
Route::get('/event-registration/{eventoId}', Registrarse::class)->name('event.registration');
Route::post('/asistencias/store', [EscanearAsistenciaPage::class, 'registerAsistencia'])
    ->name('filament.asistencias.store');
Route::get('/lector-asistencias', LectorAsistencias::class)->name('lector.asistencias');
