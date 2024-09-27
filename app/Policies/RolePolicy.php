<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RolePolicy
{   use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        // Solo el admin puede ver roles
        return $user->hasRole('administrador');
    }

    public function create(User $user)
    {
        // Solo el admin puede crear roles
        return $user->hasRole('administrador');
    }

    public function update(User $user, Role $role) // Cambiado a Role
    {
        // Solo el admin puede actualizar roles
        return $user->hasRole('administrador')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar roles.');
    }
    public function delete(User $user, Role $role)
    {
        // Solo el admin puede eliminar roles
        return $user->hasRole('administrador')
        ? Response::allow()
        : Response::deny('No tienes permiso para eliminar roles.');
    }
}
