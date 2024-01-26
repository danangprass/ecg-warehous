<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $permissions = [
            'form-repair',
            'form-modif',
            'stock-storage',
            'add-stock-storage',
            'warehouse-storage',
            'add-warehouse-storage',
            'transaction',
            'information',
            'employee-list',
            'employee-add',
            'employee-edit',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $roles = [
            'superadmin',
            'boss',
            'spv',
            'trainee',
            'employee',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        $superadmin = Role::where('name', 'superadmin')->first();
        $superadmin->givePermissionTo($permissions);

        $boss = Role::where('name', 'boss')->first();
        $boss->givePermissionTo($permissions);

        $spv = Role::where('name', 'spv')->first();
        $spv->givePermissionTo([
            'form-repair',
            'form-modif',
            'stock-storage',
            'warehouse-storage',
            'transaction',
            'information',
        ]);

        $employee = Role::where('name', 'employee')->first();
        $employee->givePermissionTo([
            'form-repair',
            'form-modif',
            'stock-storage',
            'transaction',
            'information',
        ]);

        $trainee = Role::where('name', 'trainee')->first();
        $trainee->givePermissionTo([
            'form-repair',
            'stock-storage',
            'warehouse-storage',
            'transaction',
            'information',
        ]);

        foreach ($roles as $role) {
            if ($role == 'employee') {
                // $users = User::doesntHave('roles')->inRandomOrder()->limit(rand(1, 3))->get();
                $users = User::doesntHave('roles')->inRandomOrder()->get();
                foreach ($users as $user) {
                    $user->assignRole($role);
                }
            } else {
                $user = User::doesntHave('roles')->inRandomOrder()->first();
                $user->assignRole($role);
            }
        }
    }
}
