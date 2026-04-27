<?php

namespace App\Http\Controllers;

use App\Models\ShoppingItem;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function monthly() {
        $month = now()->month;
        $year = now()->year;

        return response()->json([
            'total_bills' => Bill::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('amount'),
            'total_paid' => Payment::whereMonth('date_paid', $month)->whereYear('date_paid', $year)->sum('amount_paid'),
            'total_expenses' => Expense::whereMonth('expense_date', $month)->whereYear('expense_date', $year)->sum('amount'),
            'total_shopping' => ShoppingItem::select(DB::raw('SUM(price * quantity) as total'))->value('total'),
        ]);
    }
}
