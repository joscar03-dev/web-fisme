<?php

namespace App\Policies;

use App\Models\LugarEvento;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
class LugarEventoPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        // Verificar si el usuario tiene permisos para ver
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para ver lugares de evento.');
    }

    public function create(User $user)
    {
        // Permitir crear solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para crear lugares de evento.');
    }

    public function update(User $user, LugarEvento $lugarEvento) // Cambiado a LugarEvento
    {
        // Permitir actualizar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar lugares de evento.');
    }

    public function delete(User $user, LugarEvento $lugarEvento) // Cambiado a LugarEvento
    {
        // Permitir eliminar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar lugares de evento.');
    }
}
