<?php

namespace App\Policies;

use App\Models\Patrocinadores;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PatrocinadoresPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Verificar si el usuario tiene permisos para ver
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para ver patrocinadores.');
    }

    public function create(User $user)
    {
        // Permitir crear solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para crear patrocinadores.');
    }

    public function update(User $user, Patrocinadores $patrocinador) // Cambiado a Patrocinador
    {
        // Permitir actualizar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar patrocinadores.');
    }

    public function delete(User $user, Patrocinadores $patrocinador) // Cambiado a Patrocinador
    {
        // Permitir eliminar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar patrocinadores.');
    }
}
