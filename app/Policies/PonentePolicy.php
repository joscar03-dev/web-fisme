<?php

namespace App\Policies;

use App\Models\Ponente;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PonentePolicy
{
    public function viewAny(User $user)
    {
        // Solo el admin puede ver permisos
        return $user->hasRole('administrador');
    }

    public function create(User $user)
    {
        // Solo el admin puede crear permisos
        return $user->hasRole('administrador');
    }

    public function update(User $user, Ponente $ponente) // Cambiado a Permission
    {
        // Solo el admin puede actualizar permisos
        return $user->hasRole('administrador')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar permisos.');
    }

    public function delete(User $user, Ponente $ponente) // Cambiado a Permission
    {
        // Solo el admin puede eliminar permisos
        return $user->hasRole('administrador')
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar permisos.');
    }
}
