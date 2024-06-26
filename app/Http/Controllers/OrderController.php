<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use App\Services\PayseraTransferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;
    protected $payseraTransferService;

    public function __construct(PayseraTransferService $payseraTransferService)
    {
        $this->payseraTransferService = $payseraTransferService;
        $this->orderService = new OrderService();

        $this->middleware('auth:api');
    }

    public function index()
    {
        return response()->json(OrderResource::collection(Auth::user()->orders));

    }
    public function checkout()
    {
        $order = $this->orderService->createOrder();

        $this->payseraTransferService->createTransfer($order->total_amount);

        return response()->json(OrderResource::make($order));
    }
}
