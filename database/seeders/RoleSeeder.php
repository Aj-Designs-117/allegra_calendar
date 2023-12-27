<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role3 = Role::create(['name' => 'DevAdministrador']);
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Estudiante']);

        Permission::create(['name' => 'admin.index', 'description' => 'Ver pagina administrador'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.users.create', 'description' => 'Crear un usuario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Editar un usuario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.users.store', 'description' => 'Guardar usuario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.users.rol', 'description' => 'Asignar rol'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.users.storeRol', 'description' => 'Guardar rol'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.users.update', 'description' => 'Actualizar un usuario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.users.destroy', 'description' => 'Borrar un usuario'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'admin.profile.index', 'description' => 'Ver pagina de perfil'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.profile.update', 'description' => 'Actualizar datos de perfil'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.profile.twofactors', 'description' => 'Autenticacion de dos factores'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.profile.session', 'description' => 'Manipulacion de sesiones'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.profile.destroy', 'description' => 'Borrar cuenta'])->syncRoles([$role1, $role3]);


        Permission::create(['name' => 'admin.rolesPermissions.index', 'description' => 'Ver pagina de lista de roles'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.rolesPermissions.create', 'description' => 'Ver pagina de crear un rol'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.rolesPermissions.edit', 'description' => 'Editar roles y permisos'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.rolesPermissions.store', 'description' => 'Guardar roles y permisos'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.rolesPermissions.update', 'description' => 'Actualizar roles y permisos'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.rolesPermissions.destroy', 'description' => 'Borrar roles'])->syncRoles([$role3]);

        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver pagina de roles'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.roles.store', 'description' => 'Guardar un rol'])->syncRoles([$role3]);

        Permission::create(['name' => 'admin.permissions.index', 'description' => 'Ver pagina de permisos'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.permissions.store', 'description' => 'Guardar un permiso'])->syncRoles([$role3]);


        Permission::create(['name' => 'admin.events.index', 'description' => 'Ver pagina de horarios'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.events.create', 'description' => 'Crear un horario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.events.edit', 'description' => 'Editar un horario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.events.store', 'description' => 'Guardar un horario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.events.update', 'description' => 'Actualizar un horario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.events.destroy', 'description' => 'Borrar un horario '])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'admin.subscriptions.index', 'description' => 'Ver pagina de suscripciones'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.subscriptions.create', 'description' => 'Crear una nueva suscripcion'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.subscriptions.store', 'description' => 'Guardar una suscripcion'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.subscriptions.package', 'description' => 'Asignar una suscripcion a un usuario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.subscriptions.destroy', 'description' => 'Borrar una suscripcion '])->syncRoles([$role1, $role3]);
    }
}
