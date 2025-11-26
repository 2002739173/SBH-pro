<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()
            ->with('items') // جلب تفاصيل الأصناف مع الطلب
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('status'); // تجميع الطلبات حسب الحالة (Confirmed, In Progress, etc.)

        return response()->json($orders);
    }

    /**
     * إنشاء طلب جديد (من واجهة "Order The Bread").
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'bread_type' => 'required|string|max:255',
            'bread_size' => 'required|string|max:255',
            'special_notes' => 'nullable|string',
            // نفترض أن السعر ثابت لغرض هذا المثال
            'item_price' => 'required|numeric|min:0.01',
        ]);

        try {
            DB::beginTransaction();

            // حساب السعر الكلي
            $totalPrice = $validated['quantity'] * $validated['item_price'];

            // 1. إنشاء الطلب الرئيسي
            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => '#' . rand(100000, 999999),
                'delivery_date' => $validated['date'],
                'total_price' => $totalPrice,
                'special_notes' => $validated['special_notes'],
                'status' => 'Confirmed',
            ]);

            // 2. إضافة صنف الطلب
            OrderItem::create([
                'order_id' => $order->id,
                'bread_type' => $validated['bread_type'],
                'bread_size' => $validated['bread_size'],
                'quantity' => $validated['quantity'],
                'price' => $validated['item_price'],
            ]);

            DB::commit();

            // واجهة "Order Complete"
            return response()->json([
                'message' => 'Order Complete',
                'order' => $order->load('items')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Order creation failed.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * إلغاء طلب (من واجهة My Orders - 'Cancel Order').
     */
    public function cancel(Request $request, Order $order)
    {
        // 1. التحقق من أن الطلب يخص المستخدم الحالي
        if ($order->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized or order not found.'], 403);
        }

        // 2. التحقق من الحالة (يمكن الإلغاء إذا كان مؤكدًا أو قيد التنفيذ فقط)
        if ($order->status !== 'Confirmed' && $order->status !== 'In Progress') {
            return response()->json(['message' => 'Order cannot be canceled at this stage.'], 400);
        }

        // 3. تحديث الحالة
        $order->update(['status' => 'Canceled']);

        return response()->json(['message' => 'Order #' . $order->order_number . ' has been canceled.'], 200);
    }
}
