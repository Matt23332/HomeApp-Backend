<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index() {
        $payments = Payment::all();
        return response()->json(['message' => 'Payments retrieved successfully', 'data' => $payments], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bill_id' => 'required|exists:bills,id',
            'amount_paid' => 'required|numeric',
            'payment_method' => 'required|string|max:255',
            'payment_date' => 'required|date',
        ]);

        $payment = Payment::create($validated);
        return response()->json(['message' => 'Payment created successfully', 'data' => $payment], 201);
    }

    public function show($id) {
        $payment = Payment::findOrFail($id);
        return response()->json(['message' => 'Payment retrieved successfully', 'data' => $payment], 200);
    }

    public function update(Request $request, $id) {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'bill_id' => 'sometimes|required|exists:bills,id',
            'amount_paid' => 'sometimes|required|numeric',
            'payment_method' => 'sometimes|required|string|max:255',
            'payment_date' => 'sometimes|required|date',
        ]);

        $payment->update($validated);
        return response()->json(['message' => 'Payment updated successfully', 'data' => $payment], 200);
    }

    public function destroy($id) {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully'], 200);
    }

}
