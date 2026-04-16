<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bill;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bills = [
            [
                'title' => 'Electricity Bill',
                'amount' => 100.50,
                'due_date' => '2024-07-15',
                'user_id' => 1,
            ],
            [
                'title' => 'Water Bill',
                'amount' => 30.75,
                'due_date' => '2024-07-20',
                'user_id' => 1,
            ],
            [
                'title' => 'Internet Bill',
                'amount' => 50.00,
                'due_date' => '2024-07-25',
                'user_id' => 2,
            ],
        ];

        foreach ($bills as $bill) {
            Bill::firstOrCreate(
                ['title' => $bill['title'], 'user_id' => $bill['user_id']],
                [
                    'amount' => $bill['amount'],
                    'due_date' => $bill['due_date'],
                ]
            );
        }
    }
}
