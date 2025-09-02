<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report.index');
    }

    public function filterOrders(Request $request)
    {
        $query = Order::query()->with('orderDetails');

        // Filter by date range
        if (!empty($request->from) && !empty($request->to)) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        // Filter by status
        if ($request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Return data for DataTables
        return DataTables::of($query)
            ->addColumn('paid_total', function ($order) {
                return $order->orderDetails->sum('amount');
            })
            ->make(true);
    }
}
