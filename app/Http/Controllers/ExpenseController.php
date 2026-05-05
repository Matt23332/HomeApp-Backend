<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index() {
        $expenses = Expense::all();
        return response()->json(['message' => 'Expenses retrieved successfully', 'data' => $expenses], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category' => 'required|string|max:255',
            'expense_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $expense = Expense::create($validated);
        return response()->json(['message' => 'Expense created successfully', 'data' => $expense], 201);
    }

    public function show($id) {
        $expense = Expense::findOrFail($id);
        return response()->json(['message' => 'Expense retrieved successfully', 'data' => $expense], 200);
    }

    public function update(Request $request, $id) {
        $expense = Expense::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric',
            'category' => 'sometimes|required|string|max:255',
            'expense_date' => 'sometimes|required|date',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $expense->update($validated);
        return response()->json(['message' => 'Expense updated successfully', 'data' => $expense], 200);
    }

    public function destroy($id) {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json(['message' => 'Expense deleted successfully'], 200);
    }

    public function summary(Request $request) {
        $user = $request->user();
        $period = $request->get('period', 'monthly');

        switch($period) {
            case 'weekly':
                $startDate = now()->startOfWeek();
                break;
            case 'yearly':
                $startDate = now()->startOfYear();
                break;
            default:
                $startDate = now()->startOfMonth();
                break;
        }

        $expenses = Expense::where('user_id', $user->id)
            ->where('expense_date', '>=', $startDate)
            ->select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->get();

        return response()->json(['message' => 'Expense summary retrieved successfully', 'data' => $expenses], 200);
    }

}
