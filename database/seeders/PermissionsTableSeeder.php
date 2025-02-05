<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'empresa_create',
            ],
            [
                'id'    => 18,
                'title' => 'empresa_edit',
            ],
            [
                'id'    => 19,
                'title' => 'empresa_show',
            ],
            [
                'id'    => 20,
                'title' => 'empresa_delete',
            ],
            [
                'id'    => 21,
                'title' => 'empresa_access',
            ],
            [
                'id'    => 22,
                'title' => 'empleado_create',
            ],
            [
                'id'    => 23,
                'title' => 'empleado_edit',
            ],
            [
                'id'    => 24,
                'title' => 'empleado_show',
            ],
            [
                'id'    => 25,
                'title' => 'empleado_delete',
            ],
            [
                'id'    => 26,
                'title' => 'empleado_access',
            ],
            [
                'id'    => 27,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 28,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 29,
                'title' => 'contrato_create',
            ],
            [
                'id'    => 30,
                'title' => 'contrato_edit',
            ],
            [
                'id'    => 31,
                'title' => 'contrato_show',
            ],
            [
                'id'    => 32,
                'title' => 'contrato_delete',
            ],
            [
                'id'    => 33,
                'title' => 'contrato_access',
            ],
            [
                'id'    => 34,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
