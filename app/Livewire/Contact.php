<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{public $name = '';
    public $email = '';
    public $message = '';
    public $success = false;

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

        Mail::to('informes@untrm.edu.pe')->send(new ContactFormMail($validatedData));

        $this->reset(['name', 'email', 'message']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.contact');
    }
   
}
