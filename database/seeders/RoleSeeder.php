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
        $passenger=Role::create(['name'=>'passenger']);
        $company=Role::create(['name'=>'company']);
        $admin=Role::create(['name'=>'admin']);

        Permission::create(['name'=>'homePassenger'])->syncRoles([$passenger]);
        Permission::create(['name'=>'homeCompany'])->syncRoles([$company]);
        Permission::create(['name'=>'rellenoBilleteDatos'])->syncRoles([$passenger]);
        Permission::create(['name'=>'vuelosIda'])->syncRoles([$passenger]);
        Permission::create(['name'=>'vuelosVuelta'])->syncRoles([$passenger]);
        Permission::create(['name'=>'carrito'])->syncRoles([$passenger]);
        Permission::create(['name'=>'pago'])->syncRoles([$passenger]);
        Permission::create(['name'=>'pagoFinal'])->syncRoles([$passenger]);


    }
}
