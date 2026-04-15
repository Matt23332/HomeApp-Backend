<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

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

}
