<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingItem;

class ShoppingItemController extends Controller
{
    public function index() {
        $items = ShoppingItem::all();
        return response()->json(['message' => 'Shopping items retrieved successfully', 'data' => $items], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'purchased' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        $item = ShoppingItem::create($validated);
        return response()->json(['message' => 'Shopping item created successfully', 'data' => $item], 201);
    }

    public function show($id) {
        $item = ShoppingItem::findOrFail($id);
        return response()->json(['message' => 'Shopping item retrieved successfully', 'data' => $item], 200);
    }

    public function update(Request $request, $id) {
        $item = ShoppingItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer',
            'purchased' => 'sometimes|required|boolean',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $item->update($validated);
        return response()->json(['message' => 'Shopping item updated successfully', 'data' => $item], 200);
    }

    public function destroy($id) {
        $item = ShoppingItem::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Shopping item deleted successfully'], 200);
    }

}
