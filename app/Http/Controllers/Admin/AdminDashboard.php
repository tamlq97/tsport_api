<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
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
        $customers = $this->getDataFilteredByDateRangePaginateByLength(Customer::getModel(), $request);

        if($request->acceptsJson()) {
            return response()->json(['customers' => $customers]);
        }

        return view("welcome");
    }

    /**
     * @param Model $model
     * @param Request $request
     * @return LengthAwarePaginator
     */
    protected function getDataFilteredByDateRangePaginateByLength(Model $model,Request $request): LengthAwarePaginator
    {
        return $model->when(
            !($request->from && $request->to),
            fn($q) => $q->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
        )
            ->when(($request->from && $request->to), fn($q) => $q->whereBetween('created_at', [$request->from, $request->to]))
            ->paginate($request->length);
    }

    public function filterSupplierBtwDate(Request $request): Application|Factory|View|JsonResponse
    {
        $suppliers = $this->getDataFilteredByDateRangePaginateByLength(Supplier::getModel(), $request);

        if($request->acceptsJson()) {
            return response()->json(['suppliers' => $suppliers]);
        }

        return view('welcome');
    }

    public function filterOrderBtwDate(Request $request): Factory|Application|View|JsonResponse
    {
        $orders = Order::join('customers','customers.user_id','=','orders.user_id')
        ->when(($request->from and $request->to), fn($q) => $q->whereBetween('orders.created_at', [$request->from, $request->to]))
        ->when(!($request->from && $request->to), fn($q) => $q->whereBetween('orders.created_at',[Carbon::now()->subDays(30), Carbon::now()]))
        ->select('orders.*', 'customers.email as customer_email')
        ->paginate($request->length);

        if($request->acceptsJson()) {
            return response()->json(['orders' => $orders]);
        }

        return view('welcome');
    }
}
