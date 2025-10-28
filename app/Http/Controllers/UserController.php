<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // get user dashboard
    public function dashboard(Request $request)
    {
        $user = auth()->user();

        // Redirect service providers to their specific dashboard
        if ($user->role === 'service_provider') {
            return redirect()->route('service-provider.dashboard');
        }

        // Get latest 5 products based on user role
        if ($user->role === 'vendor' || $user->role === 'seller') {
            // For vendors: get their own latest 5 products
            $recentProducts = Product::where('user_id', $user->id)
                ->with('category')
                ->latest()
                ->take(5)
                ->get();

            // Additional vendor stats
            $totalProducts = Product::where('user_id', $user->id)->count();
            $availableProducts = Product::where('user_id', $user->id)
                ->where('status', 'available')
                ->count();
            $featuredProducts = Product::where('user_id', $user->id)
                ->where('status', 'featured')
                ->count();

            return view('user.dashboard', compact(
                'recentProducts',
                'totalProducts',
                'availableProducts',
                'featuredProducts'
            ));
        } else {
            // For buyers: get latest 5 products from all vendors
            $recentProducts = Product::with(['category', 'user'])
                ->where('status', 'available')
                ->latest()
                ->take(5)
                ->get();

            // Additional buyer stats (optional)
            $totalProducts = Product::where('status', 'available')->count();
            $organicProducts = Product::where('status', 'available')
                ->where('sales_niche', 'organic')
                ->count();

            return view('user.dashboard', compact(
                'recentProducts',
                'totalProducts',
                'organicProducts'
            ));
        }
    }

    /**
     * Display vendor profile page.
     */
    public function vendorProfile($slug)
    {
        $vendor = User::where('slug', $slug)
            ->whereIn('role', ['vendor', 'seller'])
            ->firstOrFail();

        $products = Product::where('user_id', $vendor->id)
            ->where('status', 'active')
            ->with('category')
            ->latest()
            ->paginate(12);

        return view('vendor.profile', compact('vendor', 'products'));
    }
}
