<?php

namespace App\Policies;

use App\Livewire\Organizadores;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrganizadoresPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Verificar si el usuario tiene permisos para ver
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para ver organizadores.');
    }

    public function create(User $user)
    {
        // Permitir crear solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para crear organizadores.');
    }

    public function update(User $user, Organizadores $organizador) // Cambiado a Organizador
    {
        // Permitir actualizar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar organizadores.');
    }

    public function delete(User $user, Organizadores $organizador) // Cambiado a Organizador
    {
        // Permitir eliminar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar organizadores.');
    }
}
