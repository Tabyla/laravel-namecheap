<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'user',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = User::where('email', 'sashaperezhogin123@gmail.com')->firstOrFail();
        $user = User::where('email', 'user@example.com')->firstOrFail();

        $permissionsAdmin = [
            'use-crud',
            'use-admin-panel',
        ];

        $permissionsByRole = [
            'admin' => $permissionsAdmin,
        ];

        /* Admin */
        foreach ($permissionsAdmin as $permission) {
            Permission::create(['name' => $permission]);
            $admin->givePermissionTo($permission);
        }

        foreach ($permissionsByRole as $role => $permissions) {
            $model = Role::create(['name' => $role]);
            foreach ($permissions as $permission) {
                $model->givePermissionTo($permission);
            }
        }

        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}
