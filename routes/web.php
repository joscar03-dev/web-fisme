<?php

use App\Livewire\Contact;
use App\Livewire\Evento;
use App\Livewire\Eventos;
use App\Livewire\HomePage;
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

Route::get('/', HomePage::class);
Route::get('/evento/{id}', Evento::class)->name('evento.detalle');
Route::get('/eventos', Eventos::class);


Route::get('/contact', Contact::class);
// Route::get('/', HomePage::class);
