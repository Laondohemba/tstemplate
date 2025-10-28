<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function products()
    {
        return view('products');
    } 
    
    public function services()
    {
        return view('services');
    }

    public function logistics()
    {
        $category = ServiceCategory::where('slug', 'logistics-and-freight-forwarding')->first();
        $services = $category ? Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user'])
            ->latest()
            ->get() : collect();
            
        return view('services.logistics', compact('services', 'category'));
    }

    public function warehousing()
    {
        $category = ServiceCategory::where('slug', 'warehousing-and-cold-storage')->first();
        $services = $category ? Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user'])
            ->latest()
            ->get() : collect();
            
        return view('services.warehousing', compact('services', 'category'));
    }

    public function quality()
    {
        $category = ServiceCategory::where('slug', 'quality-inspection-and-certification')->first();
        $services = $category ? Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user'])
            ->latest()
            ->get() : collect();
            
        return view('services.quality', compact('services', 'category'));
    }

    public function export()
    {
        $category = ServiceCategory::where('slug', 'export-advisory-and-trade-consulting')->first();
        $services = $category ? Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user'])
            ->latest()
            ->get() : collect();
            
        return view('services.export', compact('services', 'category'));
    }

    public function packaging()
    {
        $category = ServiceCategory::where('slug', 'packaging-and-branding')->first();
        $services = $category ? Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user'])
            ->latest()
            ->get() : collect();
            
        return view('services.packaging', compact('services', 'category'));
    }

    public function equipment()
    {
        $category = ServiceCategory::where('slug', 'equipment-leasing-and-machinery-supply')->first();
        $services = $category ? Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user'])
            ->latest()
            ->get() : collect();
            
        return view('services.equipment', compact('services', 'category'));
    }

    public function cooperative()
    {
        $category = ServiceCategory::where('slug', 'cooperative-association')->first();
        $services = $category ? Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user'])
            ->latest()
            ->get() : collect();
            
        return view('services.cooperative', compact('services', 'category'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function terms()
    {
        return view('terms');
    }

    public function privacy()
    {
        return view('privacy');
    }
}
