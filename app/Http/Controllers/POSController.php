<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('stock', '>', 0)->get();
        $categories = Category::all();
        $customers = Customer::all();
        
        return view('pos.index', compact('products', 'categories', 'customers'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'cash_received' => 'required|numeric',
            'total_amount' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_id' => $request->customer_id,
                'total_amount' => $request->total_amount,
                'cash_received' => $request->cash_received,
                'change_amount' => $request->cash_received - $request->total_amount,
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ]);

                // Reduce stock
                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();
            return response()->json(['success' => true, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
