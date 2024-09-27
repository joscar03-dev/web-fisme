<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Verificar si el usuario tiene permisos para ver usuarios
        return $user->hasRole('administrador'); // Solo el admin puede ver usuarios
    }

    public function create(User $user)
    {
        // Solo el admin puede crear usuarios
        return $user->hasRole('administrador');
    }

    public function update(User $user, User $model)
    {
        // Solo el admin puede actualizar usuarios
        return $user->hasRole('administrador');
    }

    public function delete(User $user, User $model)
    {
        // Solo el admin puede eliminar usuarios
        return $user->hasRole('administrador');
    }
}
