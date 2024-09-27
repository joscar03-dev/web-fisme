<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        Permission::create(['name' => 'ver eventos']);
        Permission::create(['name' => 'crear eventos']);
        Permission::create(['name' => 'editar eventos']);
        Permission::create(['name' => 'eliminar eventos']);
        Permission::create(['name' => 'ver registros']);
        Permission::create(['name' => 'ver asistencias']);

        // Crear roles y asignar permisos
        $role = Role::create(['name' => 'administrador'])
            ->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'administrador de evento'])
            ->givePermissionTo(['ver eventos', 'crear eventos', 'editar eventos', 'eliminar eventos']);

        $role = Role::create(['name' => 'usuario_registro'])
            ->givePermissionTo(['ver eventos', 'ver registros']);

        $role = Role::create(['name' => 'usuario_asistencia'])
            ->givePermissionTo(['ver eventos', 'ver asistencias']);
    }
}
