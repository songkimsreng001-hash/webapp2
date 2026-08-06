<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class OrderController extends Controller
{
    /**
     * Get all orders for the authenticated user.
     */
    public function index(Request $request)
    {
        try {
            $orders = Order::with(['orderItems.product'])
                ->where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Orders fetched',
                'orders'  => $orders,
            ]);

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Failed to fetch orders',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show a single order with its items.
     */
    public function show(Request $request, $id)
    {
        try {
            $order = Order::with(['orderItems.product'])
                ->where('user_id', $request->user()->id)
                ->findOrFail($id);

            return response()->json([
                'message' => 'Order fetched',
                'order'   => $order,
            ]);

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Order not found',
                'error'   => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Place a new order (called after Stripe payment success on Flutter).
     *
     * Expected JSON body:
     * {
     *   "items": [
     *     { "product_id": 1, "quantity": 2 },
     *     { "product_id": 3, "quantity": 1 }
     *   ],
     *   "payment_intent_id": "pi_xxxxxx"   // from Stripe
     * }
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'items'                  => 'required|array|min:1',
                'items.*.product_id'     => 'required|integer|exists:products,id',
                'items.*.quantity'       => 'required|integer|min:1',
                'payment_intent_id'      => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Calculate total amount from real DB prices (never trust client prices)
            $totalAmount = 0;
            $resolvedItems = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $lineTotal = $product->price * $item['quantity'];
                $totalAmount += $lineTotal;

                $resolvedItems[] = [
                    'product'    => $product,
                    'quantity'   => $item['quantity'],
                    'unit_price' => $product->price,
                    'line_total' => $lineTotal,
                ];
            }

            // Create Order
            $order = Order::create([
                'user_id'           => $request->user()->id,
                'amount'            => $totalAmount,
                'status'            => 2,   // 2 = Paid / Pending fulfillment
                'payment_intent_id' => $request->payment_intent_id,
            ]);

            // Create Order Items
            foreach ($resolvedItems as $ri) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $ri['product']->id,
                    'quantity'   => $ri['quantity'],
                    'amount'     => $ri['unit_price'],
                ]);
            }

            return response()->json([
                'message'     => 'Order placed successfully',
                'order_id'    => $order->id,
                'total_amount'=> $totalAmount,
            ], 201);

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Failed to place order',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
