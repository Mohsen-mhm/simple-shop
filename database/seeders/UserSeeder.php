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
        $godRole = Role::whereName(Role::GOD_ROLE)->first();
        $adminRole = Role::whereName(Role::ADMIN_ROLE)->first();

        $god = [
            'name' => 'marzieh',
            'email' => 'marzieh@gmail.com',
            'password' => Hash::make('123456'),
        ];
        $godUser = User::whereEmail($god['email'])->first();
        if (!$godUser) {
            $user = User::create($god);
            $user->roles()->attach($godRole);
        }

        $admin = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('654321'),
        ];
        $adminUser = User::whereEmail($admin['email'])->first();
        if (!$adminUser) {
            $user = User::create($admin);
            $user->roles()->attach($adminRole);
        }
    }
}
