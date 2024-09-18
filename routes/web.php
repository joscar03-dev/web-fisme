<?php

use App\Filament\Resources\AsistenciaResource\Pages\EscanearAsistenciaPage;
use App\Filament\Resources\ResgistroResource\Pages\TicketQrPage;
use App\Livewire\Agenda;
use App\Livewire\Contact;
use App\Livewire\Evento;
use App\Livewire\Eventos;
use App\Livewire\HomePage;
use App\Livewire\Inscripciones;
use App\Livewire\LectorAsistencias;
use App\Livewire\Organizadores;
use App\Livewire\Registrarse;
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
// Route::get('/', HomePage::class);
Route::get('/inscripcion', Inscripciones::class)->name('inscripcion');
Route::get('/event-registration/{slug}', Registrarse::class)->name('event.registration');


Route::post('/asistencias/store', [EscanearAsistenciaPage::class, 'registerAsistencia'])
    ->name('filament.asistencias.store');
Route::get('/lector-asistencias', LectorAsistencias::class)->name('lector.asistencias');
Route::get('/event/{id}', [Registrarse::class, 'show'])->name('event.show');

Route::get('/cookies/policy', function () {
    return view('cookies.policy');
})->name('cookies.policy');

Route::get('/cookies/manage', function () {
    return view('cookies.manage');
})->name('cookies.manage');


Route::post('/enviar-correo/{id}', function ($id) {
    $registro = Resgistro::findOrFail($id);
    $page = new TicketQrPage();
    $page->mount($registro);
    $page->enviarCorreo();
    return redirect()->back()->with('message', 'Correo enviado exitosamente.');
})->name('enviar-correo');
Route::get('/prueba', function () {
    Mail::to('7583976221@untrm.edu.pe')->send(new PruebaMailable);
    return "Mensaje Enviado";
})->name('prueba');
