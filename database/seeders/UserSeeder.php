<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $god = Role::whereName(Role::GOD_ROLE)->first();
        $admin = Role::whereName(Role::ADMIN_ROLE)->first();

        $items = [
            [
                'name' => 'marzieh',
                'email' => 'marzieh@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => $god->id
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('654321'),
                'role_id' => $admin->id
            ],
        ];

        foreach ($items as $item) {
            $user = User::whereEmail($item['email'])->first();

            if (!$user) {
                User::create($item);
            }
        }
    }
}
