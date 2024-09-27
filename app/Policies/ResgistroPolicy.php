<?php

namespace App\Policies;

use App\Models\Resgistro;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ResgistroPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Verificar si el usuario tiene permisos para ver
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para ver registros.');
    }

    public function create(User $user)
    {
        // Permitir crear solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para crear registros.');
    }

    public function update(User $user, Resgistro $model) // Puedes mantener $model o cambiarlo según sea necesario
    {
        // Permitir actualizar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar registros.');
    }

    public function delete(User $user,Resgistro $model) 
    {
        // Permitir eliminar solo a administradores y administradores de eventos
        return $user->hasRole('administrador') || $user->hasRole('administrador de evento')
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar registros.');
    }
}
