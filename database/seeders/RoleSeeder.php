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
        //
        $roleAdmin = Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'CrearProducto'])->assignRole($roleAdmin);
        Permission::create(['name' => 'EditarProducto'])->assignRole($roleAdmin);
        Permission::create(['name' => 'EliminarProducto'])->assignRole($roleAdmin);

        Permission::create(['name' => 'CrearCurso'])->assignRole($roleAdmin);
        Permission::create(['name' => 'EditarCurso'])->assignRole($roleAdmin);
        Permission::create(['name' => 'EliminarCurso'])->assignRole($roleAdmin);

        $roleUser = Role::create(['name' => 'Usuario']);
        Permission::create(['name' => 'AnadirProducto'])->assignRole($roleUser);
        Permission::create(['name' => 'AnadirCuro'])->assignRole($roleUser);




    }
}
