<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries for buyer.
     */
    public function index()
    {
        $user = Auth::user();
        
        $inquiries = Inquiry::where('buyer_id', $user->id)
            ->with(['vendor', 'product'])
            ->latest()
            ->paginate(15);

        return view('buyer.inquiries', compact('inquiries'));
    }

    /**
     * Display a listing of inquiries for vendor.
     */
    public function vendorInquiries()
    {
        $user = Auth::user();
        
        $inquiries = Inquiry::where('vendor_id', $user->id)
            ->with(['buyer', 'product.category'])
            ->latest()
            ->paginate(15);

        return view('vendor.inquiries', compact('inquiries'));
    }

    /**
     * Show the form for creating a new inquiry.
     */
    public function create(Request $request)
    {
        $productId = $request->get('product_id');
        $vendorId = $request->get('vendor_id');
        
        $product = null;
        $vendor = null;
        
        if ($productId) {
            $product = Product::findOrFail($productId);
            $vendor = $product->user;
        } elseif ($vendorId) {
            $vendor = User::findOrFail($vendorId);
        }

        return view('buyer.create-inquiry', compact('product', 'vendor'));
    }

    /**
     * Store a newly created inquiry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor_id' => 'required|exists:users,id',
            'product_id' => 'nullable|exists:products,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'priority' => 'nullable|in:low,medium,high',
        ], [
            'vendor_id.required' => 'Please select a vendor',
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
            'message.min' => 'Message must be at least 10 characters',
        ]);

        $inquiry = Inquiry::create([
            'buyer_id' => Auth::id(),
            'vendor_id' => $validated['vendor_id'],
            'product_id' => $validated['product_id'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'priority' => $validated['priority'] ?? 'medium',
            'status' => 'pending',
        ]);

        // Send notification to vendor
        $vendor = User::find($validated['vendor_id']);
        if ($vendor) {
            NotificationService::notifyInquiryReceived($vendor, $inquiry);
        }

        return redirect()->route('buyer.inquiries')
            ->with('success', 'Inquiry sent successfully! The vendor will be notified.');
    }

    /**
     * Display the specified inquiry.
     */
    public function show($id)
    {
        $user = Auth::user();
        
        $inquiry = Inquiry::with(['buyer', 'vendor', 'product'])
            ->where(function($query) use ($user) {
                $query->where('buyer_id', $user->id)
                      ->orWhere('vendor_id', $user->id);
            })
            ->findOrFail($id);

        return view('inquiries.show', compact('inquiry'));
    }

    /**
     * Mark inquiry as responded (vendor only).
     */
    public function respond(Request $request, $id)
    {
        $user = Auth::user();
        
        $inquiry = Inquiry::where('vendor_id', $user->id)
            ->findOrFail($id);

        // Debug logging
        \Log::info('Inquiry respond request', [
            'user_id' => $user->id,
            'inquiry_id' => $id,
            'request_method' => $request->method(),
            'is_ajax' => $request->ajax(),
            'expects_json' => $request->expectsJson(),
            'wants_json' => $request->wantsJson(),
            'has_response' => $request->has('response'),
            'response_content' => $request->input('response'),
        ]);

        // Check if this is a JSON request (from AJAX mark as responded)
        if ($request->expectsJson() || $request->isJson()) {
            // Handle AJAX request to just mark as responded
            $inquiry->update([
                'status' => 'responded',
                'responded_at' => now(),
            ]);

            // Send notification to buyer
            $buyer = $inquiry->buyer;
            if ($buyer) {
                NotificationService::notifyInquiryResponded($buyer, $inquiry);
            }

            return response()->json([
                'success' => true,
                'message' => 'Inquiry marked as responded successfully!'
            ]);
        }

        // Handle form submission with response
        $validated = $request->validate([
            'response' => 'required|string|min:10',
        ]);

        // Update inquiry status
        $inquiry->update([
            'status' => 'responded',
            'responded_at' => now(),
        ]);

        // Send notification to buyer
        $buyer = $inquiry->buyer;
        if ($buyer) {
            NotificationService::notifyInquiryResponded($buyer, $inquiry);
        }

        // Always return JSON response for AJAX requests (including form submissions)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Response sent successfully!'
            ]);
        }

        return redirect()->route('vendor.inquiries')
            ->with('success', 'Response sent successfully!');
    }

    /**
     * Close an inquiry.
     */
    public function close($id)
    {
        $user = Auth::user();
        
        $inquiry = Inquiry::where(function($query) use ($user) {
                $query->where('buyer_id', $user->id)
                      ->orWhere('vendor_id', $user->id);
            })
            ->findOrFail($id);

        $inquiry->update(['status' => 'closed']);

        return redirect()->back()
            ->with('success', 'Inquiry closed successfully!');
    }

    /**
     * Delete an inquiry.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        $inquiry = Inquiry::where('buyer_id', $user->id)
            ->findOrFail($id);

        $inquiry->delete();

        return redirect()->route('buyer.inquiries')
            ->with('success', 'Inquiry deleted successfully!');
    }
}