<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    //inject thằng OrderRepositoryInterface thông qua khởi tạo
    public function __construct(OrderRepositoryInterface $orderRepository) 
    {
        $this->orderRepository = $orderRepository;
    }
    
    //danh sách các đơn hàng
    public function index() : JsonResponse
    {
        return response()->json([
            'data' => $this->orderRepository->getAllOrders()
        ]);
    }

   
    public function create()
    {
        //
    }

    //  Tạo 1 đơn hàng mới
    public function store(Request $request): JsonResponse 
    {
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json(
            [
                'data' => $this->orderRepository->createOrder($orderDetails)
            ],
            Response::HTTP_CREATED
        );
    }

    //CHi tiết đơn hàng
    public function show(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');

        return response()->json([
            'data' => $this->orderRepository->getOrderById($orderId)
        ]);
    }

    public function edit(Order $order)
    {
        //
    }

    //Update đơn hàng
    public function update(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->orderRepository->updateOrder($orderId, $orderDetails)
        ]);
    }

    //xóa 1 đơn hàng
    public function destroy(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');
        $this->orderRepository->deleteOrder($orderId);

        return response()->json(null, Reponse::HTTP_NO_CONTENT);
    }
}
