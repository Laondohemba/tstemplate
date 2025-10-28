<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $user = Auth::user();
        
        // If user is admin, show all services
        if ($user->role === 'admin') {
            $services = Service::with(['serviceCategory', 'user'])
                ->latest()
                ->paginate(12);
        } else {
            // Show only user's own services
            $services = Service::where('user_id', $user->id)
                ->with(['serviceCategory'])
                ->latest()
                ->paginate(12);
        }

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $user = Auth::user();
        
        // Get the user's locked category (set during registration)
        $lockedCategory = $user->service_category_id;
        
        // If user has a locked category, only show that one
        if ($lockedCategory) {
            $categories = ServiceCategory::where('id', $lockedCategory)->where('is_active', true)->get();
        } else {
            // Fallback to all categories if not set
            $categories = ServiceCategory::where('is_active', true)->get();
        }
        
        return view('services.create', compact('categories', 'lockedCategory'));
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        // Debug logging
        \Log::info('Service creation attempt', [
            'user_id' => Auth::id(),
            'request_data' => $request->all(),
            'has_files' => $request->hasFile('images'),
        ]);

        $user = Auth::user();
        
        // Enforce locked category
        $lockedCategory = $user->service_category_id;
        if ($lockedCategory && $request->input('service_category_id') != $lockedCategory) {
            return back()->withInput()
                ->withErrors(['service_category_id' => 'You can only create services in your registered service category.']);
        }

        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'location' => 'required|string|max:255',
            'coverage_area' => 'nullable|string|max:255',
            'services_offered' => 'required|array|min:1',
            'services_offered.*' => 'nullable|string|max:255',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'website' => 'nullable|url',
        ], [
            'service_category_id.required' => 'Please select a service category',
            'company_name.required' => 'Company name is required',
            'description.required' => 'Service description is required',
            'description.min' => 'Description must be at least 10 characters',
            'email.required' => 'Email address is required',
            'phone.required' => 'Phone number is required',
            'location.required' => 'Location is required',
            'services_offered.required' => 'Please specify at least one service offered',
            'images.max' => 'You can upload a maximum of 5 images',
            'images.*.image' => 'All files must be images',
            'images.*.mimes' => 'Images must be in JPEG, PNG, GIF, or WebP format',
            'images.*.max' => 'Each image must not exceed 5MB',
        ]);

        \Log::info('Validation passed', ['validated_data' => $validated]);

        // Filter out empty and null services_offered values
        $validated['services_offered'] = array_filter($validated['services_offered'], function($service) {
            return !empty(trim($service)) && $service !== null;
        });

        // Re-validate that we have at least one service after filtering
        if (empty($validated['services_offered'])) {
            return back()->withInput()
                ->withErrors(['services_offered' => 'Please specify at least one service offered']);
        }

        \Log::info('Services filtered', ['services_offered' => $validated['services_offered']]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('services', $filename, 'public');
                $imagePaths[] = $path;
            }
        }

        // Create service
        try {
            $service = Service::create([
            'user_id' => Auth::id(),
            'service_category_id' => $validated['service_category_id'],
            'company_name' => $validated['company_name'],
            'slug' => Str::slug($validated['company_name'] . '-' . uniqid()),
            'description' => $validated['description'],
            'contact_person' => $validated['contact_person'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'location' => $validated['location'],
            'coverage_area' => $validated['coverage_area'],
            'services_offered' => $validated['services_offered'],
            'images' => $imagePaths,
            'website' => $validated['website'],
            'verification_status' => 'verified',
            'status' => 'active',
        ]);

        \Log::info('Service created successfully', ['service_id' => $service->id]);

        return redirect()->route('services.index')
            ->with('success', 'Service provider profile created successfully! It will be reviewed before going live.');
    } catch (\Exception $e) {
        \Log::error('Service creation failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return back()->withInput()
            ->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified service.
     */
    public function show($slug)
    {
        $service = Service::with(['serviceCategory', 'user'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($slug)
    {
        $user = Auth::user();
        $service = Service::where('slug', $slug)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $categories = ServiceCategory::where('is_active', true)->get();

        return view('services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, $slug)
    {
        $user = Auth::user();
        $service = Service::where('slug', $slug)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'location' => 'required|string|max:255',
            'coverage_area' => 'nullable|string|max:255',
            'services_offered' => 'required|array|min:1',
            'services_offered.*' => 'nullable|string|max:255',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'website' => 'nullable|url',
        ]);

        // Handle image uploads if new images provided
        if ($request->hasFile('images')) {
            // Delete old images
            if ($service->images) {
                foreach ($service->images as $oldImage) {
                    if (\Storage::disk('public')->exists($oldImage)) {
                        \Storage::disk('public')->delete($oldImage);
                    }
                }
            }

            // Upload new images
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('services', $filename, 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
        } else {
            unset($validated['images']);
        }

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service provider profile updated successfully!');
    }

    /**
     * Remove the specified service.
     */
    public function destroy($slug)
    {
        $user = Auth::user();
        $service = Service::where('slug', $slug)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Delete images
        if ($service->images) {
            foreach ($service->images as $image) {
                if (\Storage::disk('public')->exists($image)) {
                    \Storage::disk('public')->delete($image);
                }
            }
        }

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service provider profile deleted successfully!');
    }

    /**
     * Display services by category (public view).
     */
    public function category($slug)
    {
        $category = ServiceCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $services = Service::where('service_category_id', $category->id)
            ->where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['user'])
            ->latest()
            ->paginate(12);

        return view('services.category', compact('category', 'services'));
    }

    /**
     * Display public service providers listing.
     */
    public function publicIndex(Request $request)
    {
        $query = Service::where('status', 'active')
            ->where('verification_status', 'verified')
            ->with(['serviceCategory', 'user']);

        // Apply filters
        if ($request->filled('search')) {
            $query->where('company_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('service_category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $services = $query->latest()->paginate(12);

        return view('service-providers.index', compact('services'));
    }
}
