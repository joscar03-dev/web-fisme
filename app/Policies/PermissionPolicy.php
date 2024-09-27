<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
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

    public function update(User $user, Permission $permission) // Cambiado a Permission
    {
        // Solo el admin puede actualizar permisos
        return $user->hasRole('administrador')
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar permisos.');
    }

    public function delete(User $user, Permission $permission) // Cambiado a Permission
    {
        // Solo el admin puede eliminar permisos
        return $user->hasRole('administrador')
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar permisos.');
    }
}
