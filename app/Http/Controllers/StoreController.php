<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Throwable;

class StoreController extends Controller
{

    public function cart()
    {
        return view('frontend.cart');
    }
  
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $requestedQuantity = max(1, min(99, (int) $request->input('quantity', 1)));
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = min(99, $cart[$id]['quantity'] + $requestedQuantity);
        } else {
            $cart[$id] = [
              "product_id"=>$product->id,
                "name" => $product->name,
                "quantity" => $requestedQuantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $request->validate(['id' => ['required'], 'quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = (int) $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
  
    public function remove(Request $request)
    {
        $request->validate(['id' => ['required']]);
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $totalAmount = collect($cart)->sum(fn ($item) => (float) $item['price'] * (int) $item['quantity']);

        return view('frontend.checkout', [
            'cartItems' => $cart,
            'totalAmount' => $totalAmount,
            'stripeKey' => config('services.stripe.key'),
        ]);
    }

    public function completeCheckout(Request $request)
    {
        $request->validate([
            'payment_intent_id' => ['required', 'string'],
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $intent = PaymentIntent::retrieve($request->payment_intent_id);

            $totalAmount = collect($cart)->sum(fn ($item) => (float) $item['price'] * (int) $item['quantity']);
            $expectedCents = (int) round($totalAmount * 100);

            if ($intent->status !== 'succeeded' || (int) $intent->amount !== $expectedCents || (string) ($intent->metadata->user_id ?? '') !== (string) Auth::id()) {
                return redirect()->route('cart.checkout')->with('error', 'Payment could not be verified.');
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'amount' => $totalAmount,
                'status' => Order::STATUS_PAID,
                'payment_intent_id' => $intent->id,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'amount' => $item['price'],
                ]);
            }

            session()->forget('cart');

            return redirect()->route('cart')->with('success', 'Payment successful. Your order has been placed.');
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('cart.checkout')->with('error', 'We could not verify the payment. Please try again.');
        }
    }
}
