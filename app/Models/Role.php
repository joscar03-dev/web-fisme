<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'guard_name'];
      // Relación con permisos
      public function permissions()
      {
          return $this->belongsToMany(Permission::class, 'role_has_permissions');
      }
  
      // Relación con usuarios
      public function users()
      {
          return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id')
                      ->wherePivot('model_type', User::class);
      }
}
