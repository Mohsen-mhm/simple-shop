<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'GOD',
                'title' => 'god',
            ],
            [
                'name' => 'ADMIN',
                'title' => 'admin',
            ],
            [
                'name' => 'CUSTOMER',
                'title' => 'customer',
            ],
        ];

        foreach ($items as $item) {
            $role = Role::whereName($item['name'])->first();

            if (!$role) {
                Role::create($item);
            }
        }

        $godPermissions = Permission::all();
        $godRole = Role::whereName(Role::GOD_ROLE)->first();
        $godRole->permissions()->sync($godPermissions->pluck('id'));

        $adminPermissions = Permission::whereNot('name', 'like', 'user%')
            ->whereNot('name', 'like', 'order-edit')
            ->whereNot('name', 'like', 'payment-edit')
            ->get();

        $adminRole = Role::whereName(Role::ADMIN_ROLE)->first();
        $adminRole->permissions()->sync($adminPermissions->pluck('id'));
    }
}
