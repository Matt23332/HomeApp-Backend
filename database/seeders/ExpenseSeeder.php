<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            [
                'title' => 'Groceries',
                'amount' => 150.00,
                'category' => 'Food',
                'expense_date' => '2024-07-10',
                'user_id' => 1,
            ],
            [
                'title' => 'Dining Out',
                'amount' => 75.50,
                'category' => 'Food',
                'expense_date' => '2024-07-12',
                'user_id' => 1,
            ],
            [
                'title' => 'Transportation',
                'amount' => 75.50,
                'category' => 'Transport',
                'expense_date' => '2024-07-12',
                'user_id' => 1,
            ],
            [
                'title' => 'Transportation',
                'amount' => 40.00,
                'category' => 'Transport',
                'expense_date' => '2024-07-15',
                'user_id' => 2,
            ],
        ];

        foreach ($expenses as $expense) {
            Expense::firstOrCreate(
                ['title' => $expense['title'], 'user_id' => $expense['user_id']],
                [
                    'amount' => $expense['amount'],
                    'category' => $expense['category'],
                    'expense_date' => $expense['expense_date'],
                ]
            );
        }

    }
}
