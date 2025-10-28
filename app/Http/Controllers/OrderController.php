<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display orders for buyers.
     */
    public function buyerOrders()
    {
        $user = Auth::user();
        
        $orders = Order::where('buyer_id', $user->id)
            ->with(['vendor', 'product', 'quote'])
            ->latest()
            ->paginate(15);

        return view('buyer.orders', compact('orders'));
    }

    /**
     * Display orders for vendors.
     */
    public function vendorOrders()
    {
        $user = Auth::user();
        
        $orders = Order::where('vendor_id', $user->id)
            ->with(['buyer', 'product', 'quote'])
            ->latest()
            ->paginate(15);

        return view('vendor.orders', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $user = Auth::user();
        
        $order = Order::with(['buyer', 'vendor', 'product', 'quote'])
            ->where(function($query) use ($user) {
                $query->where('buyer_id', $user->id)
                      ->orWhere('vendor_id', $user->id);
            })
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Update order status (vendor only).
     */
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        
        $order = Order::where('vendor_id', $user->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'tracking_number' => 'nullable|string|max:255',
            'expected_delivery_date' => 'nullable|date|after:today',
            'notes' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $order->status;
        $order->update($validated);

        // If delivered, set delivered_at
        if ($validated['status'] === 'delivered') {
            $order->update(['delivered_at' => now()]);
        }

        // Notify the buyer about the status update
        $buyer = User::find($order->buyer_id);
        if ($buyer && $oldStatus !== $validated['status']) {
            NotificationService::notifyOrderStatusUpdated($buyer, $order, $oldStatus, $validated['status']);
        }

        return redirect()->route('vendor.orders')
            ->with('success', 'Order status updated successfully!');
    }

    /**
     * Cancel an order (buyer only).
     */
    public function cancel($id)
    {
        $user = Auth::user();
        
        $order = Order::where('buyer_id', $user->id)
            ->where('status', 'pending')
            ->findOrFail($id);

        $order->update(['status' => 'cancelled']);

        return redirect()->route('buyer.orders')
            ->with('success', 'Order cancelled successfully!');
    }

    /**
     * Create order from quote.
     */
    public function createFromQuote(Request $request, $quoteId)
    {
        $user = Auth::user();
        
        $quote = \App\Models\Quote::where('buyer_id', $user->id)
            ->where('status', 'pending')
            ->findOrFail($quoteId);

        // Generate order number
        $orderNumber = 'ORD-' . strtoupper(uniqid());

        $order = Order::create([
            'buyer_id' => $user->id,
            'vendor_id' => $quote->vendor_id,
            'product_id' => $quote->product_id,
            'quote_id' => $quote->id,
            'order_number' => $orderNumber,
            'product_details' => $quote->description,
            'quantity' => $quote->quantity,
            'unit' => $quote->unit,
            'unit_price' => $quote->unit_price,
            'total_amount' => $quote->total_amount,
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => $user->address ?? 'Address not provided',
            'notes' => $quote->terms_conditions,
        ]);

        // Notify the vendor about the new order
        $vendor = User::find($quote->vendor_id);
        if ($vendor) {
            NotificationService::notifyNewOrder($vendor, $order);
        }

        // Update quote status
        $quote->update(['status' => 'accepted', 'accepted_at' => now()]);

        return redirect()->route('buyer.orders')
            ->with('success', 'Order created successfully!');
    }
}