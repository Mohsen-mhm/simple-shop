<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'user-create',
                'title' => 'Access to create a user',
            ],
            [
                'name' => 'user-edit',
                'title' => 'Access to edit a user',
            ],
            [
                'name' => 'user-index',
                'title' => 'Access to users index',
            ],
            [
                'name' => 'user-block',
                'title' => 'Access to block a user',
            ],
            [
                'name' => 'product-create',
                'title' => 'Access to create a product',
            ],
            [
                'name' => 'product-edit',
                'title' => 'Access to edit a product',
            ],
            [
                'name' => 'product-index',
                'title' => 'Access to products index',
            ],
            [
                'name' => 'product-delete',
                'title' => 'Access to delete a product',
            ],
            [
                'name' => 'order-edit',
                'title' => 'Access to edit a order',
            ],
            [
                'name' => 'order-index',
                'title' => 'Access to orders index',
            ],
            [
                'name' => 'payment-edit',
                'title' => 'Access to edit a payment',
            ],
            [
                'name' => 'payment-index',
                'title' => 'Access to payments index',
            ],
        ];

        foreach ($items as $item) {
            $permission = Permission::whereName($item['name'])->first();

            if (!$permission) {
                Permission::create($item);
            }
        }
    }
}
