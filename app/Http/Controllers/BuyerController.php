<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Quote;
use App\Models\SavedProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    /**
     * Display buyer dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get statistics
        $totalProducts = Product::where('status', 'available')->count();
        $myInquiries = Inquiry::where('buyer_id', $user->id)->count();
        $quotesReceived = Quote::where('buyer_id', $user->id)->count();
        $savedProducts = SavedProduct::where('user_id', $user->id)->count();
        
        // Get recent inquiries
        $recentInquiries = Inquiry::where('buyer_id', $user->id)
            ->with(['vendor', 'product'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get featured products
        $featuredProducts = Product::where('status', 'available')
            ->with(['user', 'category'])
            ->latest()
            ->take(6)
            ->get();

        return view('buyer.dashboard', compact(
            'totalProducts',
            'myInquiries', 
            'quotesReceived',
            'savedProducts',
            'recentInquiries',
            'featuredProducts'
        ));
    }

    /**
     * Display explore products page.
     */
    public function exploreProducts(Request $request)
    {
        $query = Product::where('status', 'available')
            ->with(['user', 'category']);

        // Apply filters
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(12);

        return view('buyer.explore-products', compact('products'));
    }

    /**
     * Display natural resources page.
     */
    public function naturalResources(Request $request)
    {
        $query = Product::where('status', 'available')
            ->whereHas('category', function($q) {
                $q->where('name', 'like', '%mineral%')
                  ->orWhere('name', 'like', '%resource%')
                  ->orWhere('name', 'like', '%stone%')
                  ->orWhere('name', 'like', '%ore%');
            })
            ->with(['user', 'category']);

        // Apply filters
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $products = $query->latest()->paginate(12);

        return view('buyer.natural-resources', compact('products'));
    }

    /**
     * Save a product to wishlist.
     */
    public function saveProduct(Request $request, $productId)
    {
        $user = Auth::user();
        
        // Check if already saved
        $existing = SavedProduct::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            return response()->json(['success' => false, 'message' => 'Product already saved']);
        }

        SavedProduct::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return response()->json(['success' => true, 'message' => 'Product saved successfully']);
    }

    /**
     * Remove a product from wishlist.
     */
    public function unsaveProduct(Request $request, $productId)
    {
        $user = Auth::user();
        
        SavedProduct::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Product removed from saved list']);
    }

    /**
     * Display saved products.
     */
    public function savedProducts()
    {
        $user = Auth::user();
        
        $savedProducts = SavedProduct::where('user_id', $user->id)
            ->with(['product.user', 'product.category'])
            ->latest()
            ->paginate(12);

        return view('buyer.saved-products', compact('savedProducts'));
    }

    /**
     * Display buyer profile.
     */
    public function profile()
    {
        $user = Auth::user();
        
        return view('buyer.profile', compact('user'));
    }

    /**
     * Update buyer profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        return redirect()->route('buyer.profile')
            ->with('success', 'Profile updated successfully!');
    }
}