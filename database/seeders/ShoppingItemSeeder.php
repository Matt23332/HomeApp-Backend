<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShoppingItem;

class ShoppingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shoppingItems = [
            [
                'name' => 'Milk',
                'quantity' => 2,
                'price' => 1.50,
                'user_id' => 1,
                'status'=>'pending',
            ],
            [
                'name' => 'Bread',
                'quantity' => 1,
                'price' => 2.00,
                'user_id' => 1,
                'status'=>'pending',
            ],
            [
                'name' => 'Eggs',
                'quantity' => 12,
                'price' => 0.10,
                'user_id' => 2,
                'status'=>'pending',
            ],
        ];

        foreach ($shoppingItems as $item) {
            ShoppingItem::firstOrCreate(
                ['name' => $item['name'], 'user_id' => $item['user_id']],
                [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'status' => $item['status'],
                ]
            );
        }

    }
}
