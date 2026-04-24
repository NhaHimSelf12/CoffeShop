<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();
        
        $total_revenue = Order::whereBetween('created_at', [$start_date, $end_date])->sum('total_amount');
        $total_orders = Order::whereBetween('created_at', [$start_date, $end_date])->count();
        
        $top_products = Product::withCount(['orderItems as total_sold' => function($query) use ($start_date, $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }])->orderBy('total_sold', 'desc')->take(5)->get();

        $daily_sales = Order::selectRaw('DATE(created_at) as date, sum(total_amount) as total')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('date')
            ->get();

        // Monthly Summary (Last 12 Months Trend)
        $monthly_summary = Order::selectRaw("DATE_FORMAT(created_at, '%M %Y') as month, sum(total_amount) as total, count(*) as count")
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy(DB::raw("min(created_at)"), 'desc')
            ->get();

        return view('reports.index', compact(
            'total_revenue', 
            'total_orders', 
            'top_products', 
            'daily_sales',
            'start_date',
            'end_date',
            'monthly_summary'
        ));
    }
}
