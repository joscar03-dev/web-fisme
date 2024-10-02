<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $notificationStatus = '';
    public $notificationMessage = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendMessage()
    {

        $validatedData = $this->validate();

        try {
            // Envía el correo al email ingresado por el usuario en el formulario
            Mail::to($this->email)->send(new ContactFormMail($validatedData));
    
            // Reinicia los campos del formulario después del envío
            $this->reset(['name', 'email', 'message']);
    
            // Notificación de éxito
            $this->notificationStatus = 'success';
            $this->notificationMessage = 'Mensaje enviado con éxito. Gracias por contactarnos.';
        } catch (\Exception $e) {
            // Notificación de error
            $this->notificationStatus = 'error';
            $this->notificationMessage = 'No se pudo enviar el mensaje. Por favor, inténtelo de nuevo más tarde.';
        }
    }

    public function render()
    {
        return view('livewire.contact');
    }

    public function resetNotification()
    {
        $this->notificationStatus = '';
        $this->notificationMessage = '';
    }
   
}
