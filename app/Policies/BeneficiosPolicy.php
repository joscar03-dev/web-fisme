<?php

namespace App\Policies;

use App\Models\Beneficios;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BeneficiosPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        // Verificar si el usuario tiene permisos para ver
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para ver beneficios.');
    }

    public function create(User $user)
    {
        // Permitir crear solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para crear beneficios.');
    }

    public function update(User $user, Beneficios $beneficio) // Cambiado a Beneficio
    {
        // Permitir actualizar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar beneficios.');
    }

    public function delete(User $user, Beneficios $beneficio) // Cambiado a Beneficio
    {
        // Permitir eliminar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar beneficios.');
    }
}
