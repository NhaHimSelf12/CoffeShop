<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::with('customer')
            ->when($search, function($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                      ->orWhereHas('customer', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'items.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
