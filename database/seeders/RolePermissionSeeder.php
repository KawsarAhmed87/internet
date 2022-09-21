<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

        // Permission List as array
        $permissions = [

            
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.view',
                    'role.create',
                    'role.edit',
                    'role.delete',

                ],
            ],

            [
                'group_name' => 'user',
                'permissions' => [
                    // admin Permissions
                    'user.view',
                    'user.create',
                    'user.edit',
                    'user.delete',
                ],
            ],

            [
                'group_name' => 'subscriber',
                'permissions' => [
                    // subscriber Permissions
                    'subscriber.view',
                    'subscriber.create',
                    'subscriber.edit',
                    'subscriber.delete',
                ],
            ],

            [
                'group_name' => 'product',
                'permissions' => [
                    // product Permissions
                    'product.view',
                    'product.create',
                    'product.edit',
                    'product.delete',
                ],
            ],

            [
                'group_name' => 'connection',
                'permissions' => [
                    // connection Permissions
                    'connection.view',
                    'connection.create',
                    'connection.edit',
                    'connection.delete',
                ],
            ],

            [
                'group_name' => 'accounting',
                'permissions' => [
                    // accounting Permissions
                    'accounting.view',
                    'accounting.create',
                    'accounting.edit',
                    'accounting.delete',
                ],
            ],

            [
                'group_name' => 'employee',
                'permissions' => [
                    // employee Permissions
                    'employee.view',
                    'employee.create',
                    'employee.edit',
                    'employee.delete',
                ],
            ],
            
        ];

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
