<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequestRequest;
use App\Http\Resources\OrderRequestResource;
use App\Models\OrderRequest;

class OrderRequestController extends Controller
{
    // عرض كل الطلبات
    public function index()
    {
        $orders = OrderRequest::oldest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Order requests retrieved successfully.',
            'data' => OrderRequestResource::collection($orders->items()),
            'pagination' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    // إضافة طلب جديد
    public function store(StoreOrderRequestRequest $request)
    {
        $order = OrderRequest::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Order request sent successfully.',
            'data' => new OrderRequestResource($order),
        ], 201);
    }

    // عرض طلب واحد
    public function show(string $id)
    {
        $order = OrderRequest::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order request not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new OrderRequestResource($order),
        ]);
    }

    // حذف طلب
    public function destroy(string $id)
    {
        $order = OrderRequest::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order request not found.',
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order request deleted successfully.',
        ]);
    }
}
