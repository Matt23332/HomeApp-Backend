<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Bill;
use App\Models\ShoppingItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // public function getDashboardData(Request $request) {
    //     $user = Auth::user();
    //     $currentMonth = Carbon::now()->startOfMonth();
    //     $lastMonth = Carbon::now()->subMonth()->startOfMonth();

    //     $totalPayments = Payment::where('user_id', $user->id)->sum('amount');
    //     $totalExpenses = Expense::where('user_id', $user->id)->sum('amount');
    //     $totalBalance = $totalPayments - $totalExpenses;

    //     $monthlyExpenses = Expense::where('user_id', $user->id)
    //         ->whereMonth('expense_date', Carbon::now()->month)
    //         ->sum('amount');
        
    //     $lastMonthExpenses = Expense::where('user_id', $user->id)
    //         ->whereMonth('expense_date', Carbon::now()->subMonth()->month)
    //         ->sum('amount');

    //     $expenseChange = $lastMonthExpenses > 0 ? (($monthlyExpenses - $lastMonthExpenses) / $lastMonthExpenses) * 100 : 0;
    //     $pendingBills = Bill::where('user_id', $user->id)
    //         ->where('status', 'unpaid')
    //         ->count();
        
    //     $overdueBills = Bill::where('user_id', $user->id)
    //         ->where('status', 'unpaid')
    //         ->orwhere(function($query) {
    //             $query->where('status', 'unpaid')
    //                     ->where('due_date', '<', Carbon::now());
    //         })
    //         ->count();
        
    //     $totalIncome = Payment::where('user_id', $user->id)->sum('amount');
    //     $savingsRate = $totalIncome > 0 ? round((($totalIncome - $totalExpenses) / $totalIncome) * 100, 1) : 0;
    //     $recentExpenses = Expense::where('user_id', $user->id)
    //         ->orderBy('expense_date', 'desc')
    //         ->limit(5)
    //         ->get()
    //         ->map(function($expense) {
    //             return [
    //                 'id' => $expense->id,
    //                 'title' => $expense->title,
    //                 'amount' => $expense->amount,
    //                 'category' => $expense->category,
    //                 'expense_date' => $expense->expense_date->format('Y-m-d'),
    //                 'type' => 'expense',
    //                 'icon' => $this->getCategoryIcon($expense->category),
    //                 'icon-bg' => $this->getCategoryColor($expense->category),
    //             ];
    //         });
        
    //     $recentPayments = Payment::where('user_id', $user->id)
    //         ->orderBy('payment_date', 'desc')
    //         ->limit(5)
    //         ->get()
    //         ->map(function($payment) {
    //             return [
    //                 'id' => $payment->id,
    //                 'bill_id' => $payment->bill_id,
    //                 'amount_paid' => $payment->amount_paid,
    //                 'payment_method' => $payment->payment_method,
    //                 'payment_date' => $payment->payment_date->format('Y-m-d'),
    //                 'type' => 'income',
    //                 'icon' => '💰',
    //                 'icon-bg' => '#e0f2f1',
    //             ];
    //         });

    //     $recentTransactions = $recentExpenses->concat($recentPayments)
    //         ->sortByDesc('date')
    //         ->take(10)
    //         ->values();

    //     $upcomingBills = Bill::where('user_id', $user->id)
    //         ->where('status', 'unpaid')
    //         ->where('due_date', '>=', Carbon::now())
    //         ->orderBy('due_date', 'asc')
    //         ->limit(5)
    //         ->get()
    //         ->map(function($bill) {
    //             return [
    //                 'id' => $bill->id,
    //                 'title' => $bill->title,
    //                 'amount' => $bill->amount,
    //                 'due_date' => $bill->due_date->format('Y-m-d'),
    //                 'icon' => '📅',
    //                 'icon-bg' => '#fff3e0',
    //             ];
    //         });

    //     $shoppingItems = ShoppingItem::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->limit(5)
    //         ->get();
        
    //     $budgets = $this->calculateBudgetProgress($user);
    //     $expenseBreakdown = Expense::where('user_id', $user->id)
    //         ->whereMonth('expense_date', Carbon::now()->month)
    //         ->selectRaw('category, SUM(amount) as total')
    //         ->groupBy('category')
    //         ->get();

    //     $summary = [
    //         'total_balance' => $totalBalance,
    //         'monthly_expenses' => $monthlyExpenses,
    //         'expense_change' => round($expenseChange, 1),
    //         'pending_bills' => $pendingBills,
    //         'overdue_bills' => $overdueBills,
    //         'savings_rate' => $savingsRate,
    //         'total_income' => $totalIncome,
    //         'total_expenses' => $totalExpenses,
    //     ];
    //     return response()->json([
    //         'summary' => $summary,
    //         'recent_transactions' => $recentTransactions,
    //         'upcoming_bills' => $upcomingBills,
    //         'shopping_items' => $shoppingItems,
    //         'budgets' => $budgets,
    //         'expense_breakdown' => $expenseBreakdown,
    //         'user' => [
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'role' => $user->role,
    //         ]
    //     ]);
    // }

    public function getDashboardData(Request $request) {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'summary' => [
                'total_balance' => 1000,
                'monthly_expenses' => 500,
                'expense_change' => -10.5,
                'pending_bills' => 3,
                'overdue_bills' => 1,
                'savings_rate' => 20.0,
                'total_income' => 1500,
                'total_expenses' => 500,
            ],

            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],

            'recent_transactions' => [
                [
                    'id' => 1,
                    'title' => 'Grocery Shopping',
                    'amount' => 150,
                    'category' => 'Groceries',
                    'date' => '2024-06-01',
                    'type' => 'expense',
                    'icon' => '🛒',
                    'icon-bg' => '#e0f7fa',
                ],
                [
                    'id' => 2,
                    'title' => 'Salary Payment',
                    'amount' => 2000,
                    'category' => null,
                    'date' => '2024-06-01',
                    'type' => 'income',
                    'icon' => '💰',
                    'icon-bg' => '#e0f2f1',
                ],
            ],

            'upcoming_bills' => [
                [
                    'id' => 1,
                    'title' => 'Electricity Bill',
                    'amount' => 100,
                    'due_date' => '2024-06-10',
                    'icon' => '📅',
                    'icon-bg' => '#fff3e0',
                ],
                [
                    'id' => 2,
                    'title' => 'Internet Bill',
                    'amount' => 50,
                    'due_date' => '2024-06-15',
                    'icon' => '📅',
                    'icon-bg' => '#fff3e0',
                ],
            ],

            'shopping_items' => [],
            'budgets' => [],
            'expense_breakdown' => [],
        ]);
    }

    private function getCategoryIcon($category) {
        $icons = [
            'Groceries' => '🛒',
            'Food' => '🍔',
            'Transportation' => '🚗',
            'Entertainment' => '🎬',
            'Utilities' => '💡',
            'Health' => '🏥',
            'Dining' => '🍽️',
            'Education' => '📚',
            'Shopping' => '🛍️',
            'Other' => '💸',
        ];
        return $icons[$category] ?? '❓';
    }

    private function getCategoryColor($category) {
        $colors = [
            'Groceries' => '#e0f7fa',
            'Food' => '#fff3e0',
            'Transportation' => '#e8f5e9',
            'Entertainment' => '#fce4ec',
            'Utilities' => '#e3f2fd',
            'Health' => '#f3e5f5',
            'Dining' => '#fff8e1',
            'Education' => '#ede7f6',
            'Shopping' => '#fbe9e7',
            'Other' => '#eeeeee',
        ];
        return $colors[$category] ?? '#f3f4f6';
    }

    private function calculateBudgetProgress($user) {
        $budgetLimits = [
            'Groceries' => 500,
            'Food' => 300,
            'Transportation' => 200,
            'Entertainment' => 150,
            'Utilities' => 250,
            'Health' => 200,
            'Dining' => 100,
            'Education' => 400,
            'Shopping' => 300,
            'Other' => 200,
        ];

        $currentMonth = Carbon::now()->startOfMonth();
        $budgets = [];
        foreach ($budgetLimits as $category => $limit) {
            $spent = Expense::where('user_id', $user->id)
                ->where('category', $category)
                ->whereMonth('expense_date', $currentMonth)
                ->sum('amount');
            $percentage = $limit > 0 ? round(($spent / $limit) * 100, 1) : 0;

            $budgets[] = [
                'category' => $category,
                'spent' => $spent,
                'limit' => $limit,
                'percentage' => $percentage,
            ];
        }
        return $budgets;
    }
}
