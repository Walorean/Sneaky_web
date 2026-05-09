<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'delete products']);

        $admin = Role::create(['name' => 'ADMIN']);
        $user = Role::create(['name' => 'USER']);

        $admin->givePermissionTo([
            'manage products',
            'create products',
            'delete products'
        ]);
    }
}
