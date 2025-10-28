<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Inquiry;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceProviderController extends Controller
{
    /**
     * Display service provider dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get statistics
        $totalServices = Service::where('user_id', $user->id)->count();
        $activeServices = Service::where('user_id', $user->id)->where('status', 'active')->count();
        $serviceRequests = Inquiry::where('vendor_id', $user->id)->whereNotNull('service_id')->where('status', 'pending')->count();
        $totalOrders = Order::where('vendor_id', $user->id)->count();
        
        // Get recent services
        $recentServices = Service::where('user_id', $user->id)
            ->with('serviceCategory')
            ->latest()
            ->take(6)
            ->get();

        return view('service-provider.dashboard', compact(
            'totalServices',
            'activeServices', 
            'serviceRequests',
            'totalOrders',
            'recentServices'
        ));
    }

    /**
     * Display service requests.
     */
    public function requests()
    {
        $user = Auth::user();
        
        $requests = Inquiry::where('vendor_id', $user->id)
            ->whereNotNull('service_id')
            ->with(['buyer', 'service'])
            ->latest()
            ->paginate(10);

        return view('service-provider.requests', compact('requests'));
    }

    /**
     * Display service provider orders.
     */
    public function orders()
    {
        $user = Auth::user();
        
        // For now, we'll show all orders for the service provider
        // In the future, we might want to add a service_id field to orders
        $orders = Order::where('vendor_id', $user->id)
            ->with(['user', 'product'])
            ->latest()
            ->paginate(10);

        return view('service-provider.orders', compact('orders'));
    }
}