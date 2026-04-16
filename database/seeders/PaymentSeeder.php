<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                'user_id' => 1,
                'bill_id' => 1,
                'amount_paid' => 100.50,
                'payment_method' => 'Credit Card',
                'payment_date' => '2024-07-16',
            ],
            [
                'user_id' => 1,
                'bill_id' => 2,
                'amount_paid' => 30.75,
                'payment_method' => 'Bank Transfer',
                'payment_date' => '2024-07-21',
            ],
            [
                'user_id' => 2,
                'bill_id' => 3,
                'amount_paid' => 20.00,
                'payment_method' => 'Cash',
                'payment_date' => '2024-07-10',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::firstOrCreate(
                ['bill_id' => $payment['bill_id'], 'user_id' => $payment['user_id']],
                [
                    'amount_paid' => $payment['amount_paid'],
                    'payment_method' => $payment['payment_method'],
                    'payment_date' => $payment['payment_date'],
                ]
            );
        }
    }
}
