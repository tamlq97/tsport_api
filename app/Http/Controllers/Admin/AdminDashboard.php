<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class AdminDashboard extends Controller
{
    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index(): View|Factory|JsonResponse|Application
    {
        $data = [];
        $data['products'] = Product::count();
        $data['orders'] = Order::count();
        $data['customers'] = Customer::count();
        $data['suppliers'] = Supplier::count();
        if(request()->acceptsJson()) {
            return response()->json(['data' => $data]);
        }

        return view('welcome');
    }

    /**
     * @param Request $request
     * @return Factory|View|Application|JsonResponse
     */
    public function filterCustomerBtwDate(Request $request): Application|Factory|View|JsonResponse
    {
        $query = Customer::whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
        if ($request->from && $request->to) {
            $query = $query->whereBetween('created_at', [$request->from, $request->to]);
        }
        $customers = $query->paginate($request->length);
        if($request->acceptsJson()) {
            return response()->json(['customers' => $customers]);
        }

        return view("welcome");
    }

    public function filterSupplierBtwDate(Request $request): Application|Factory|View|JsonResponse
    {
        $suppliers = DB::table('suppliers')
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
        if ($request->from && $request->to) {
            $suppliers = DB::table('suppliers')
                ->whereBetween('created_at', [$request->from, $request->to]);
        }
        $suppliers = $suppliers->paginate($request->length);
        if($request->acceptsJson()) {
            return response()->json(['suppliers' => $suppliers]);
        }
        return view('welcome');
    }

    public function filterOrderBtwDate(Request $request): Factory|Application|View|JsonResponse
    {
        $orders = DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.user_id')
            ->whereBetween('orders.created_at', [$request->from, $request->to])
            ->select('orders.*', 'customers.email as customer_email');
        $orders = $orders->paginate($request->length);
        if($request->acceptsJson()) {
            return response()->json(['orders' => $orders]);
        }

        return view('welcome');
    }
}
