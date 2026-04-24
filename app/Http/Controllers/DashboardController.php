<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $products_count = Product::count();
        $categories_count = Category::count();
        $customers_count = Customer::count();
        $total_orders = Order::count();
        $total_sales = Order::sum('total_amount');

        $recent_orders = Order::with('customer')->latest()->take(5)->get();

        // Fetch daily sales for the last 7 days
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        $daily_sales_raw = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $chart_labels = [];
        $chart_data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayName = now()->subDays($i)->format('D');
            $chart_labels[] = $dayName;
            $chart_data[] = $daily_sales_raw->get($date, 0);
        }

        if (auth()->user()->role === 'staff') {
            return view('staff-dashboard', compact(
                'products_count',
                'categories_count',
                'customers_count',
                'recent_orders',
                'total_orders'
            ));
        }

        return view('dashboard', compact(
            'products_count',
            'categories_count',
            'customers_count',
            'total_sales',
            'recent_orders',
            'total_orders',
            'chart_labels',
            'chart_data'
        ));
    }

    public function getDashboardData(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $selectedDate = \Carbon\Carbon::parse($request->date);

        // Calculate 7-day period ending on selected date
        $startDate = (clone $selectedDate)->subDays(6)->startOfDay();
        $endDate = (clone $selectedDate)->endOfDay();

        $daily_sales_raw = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $chart_labels = [];
        $chart_data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = (clone $selectedDate)->subDays($i)->format('Y-m-d');
            $dayName = (clone $selectedDate)->subDays($i)->format('D');
            $chart_labels[] = $dayName;
            $chart_data[] = $daily_sales_raw->get($date, 0);
        }

        // Calculate stats for the selected period
        $total_sales = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
        $total_orders = Order::whereBetween('created_at', [$startDate, $endDate])->count();

        // Get unique customers in period
        $customers = Order::whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('customer_id')
            ->distinct('customer_id')
            ->count('customer_id');

        $products_count = Product::count();

        return response()->json([
            'labels' => $chart_labels,
            'data' => $chart_data,
            'stats' => [
                'sales' => $total_sales,
                'orders' => $total_orders,
                'customers' => $customers,
                'products' => $products_count,
            ],
        ]);
    }
}
