<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'index products']);
        Permission::create(['name' => 'show products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);

        // Assign permissions to roles

        $admin->givePermissionTo(Permission::all());

        $user->givePermissionTo(['index products', 'show products']);

    }
}
