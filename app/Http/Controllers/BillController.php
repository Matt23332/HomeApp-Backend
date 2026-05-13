<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index() {
        $bills = Bill::all();
        return response()->json(['message' => 'Bills retrieved successfully', 'data' => $bills], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();
        $bill = Bill::create($validated);
        return response()->json(['message' => 'Bill created successfully', 'data' => $bill], 201);
    }

    public function show($id) {
        $bill = Bill::findOrFail($id);
        return response()->json(['message' => 'Bill retrieved successfully', 'data' => $bill], 200);
    }

    public function update(Request $request, $id) {
        $bill = Bill::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric',
            'due_date' => 'sometimes|required|date',
        ]);

        $bill->update($validated);
        return response()->json(['message' => 'Bill updated successfully', 'data' => $bill], 200);
    }

    public function destroy($id) {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return response()->json(['message' => 'Bill deleted successfully'], 200);
    }
}
