<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Buyer: show only available or featured products
        if ($user->role === 'buyer') {
            $products = Product::whereIn('status', ['available', 'featured'])
                ->with('category')
                ->latest()
                ->paginate(12);
        }

        // Admin: show all products
        elseif ($user->role === 'admin') {
            $products = Product::with('category')
                ->latest()
                ->paginate(12);
        }

        // Vendor: show only products that belong to this user
        elseif ($user->role === 'vendor') {
            $products = $user->products()
                ->with('category')
                ->latest()
                ->paginate(12);
        }

        // Service Provider: show only products that belong to this user
        elseif ($user->role === 'service_provider') {
            $products = $user->products()
                ->with('category')
                ->latest()
                ->paginate(12);
        }

        // Default: show available products for any other role
        else {
            $products = Product::where('status', 'available')
                ->with('category')
                ->latest()
                ->paginate(12);
        }

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // method for products
    public function appProducts(Request $request)
    {
        // Get all categories for the dropdown
        $categories = Category::all();

        // Start building the query
        $query = Product::with(['category', 'user'])
            ->where('status', 'available');

        // Apply category filter
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Apply sales type filter
        if ($request->has('sales_type') && $request->sales_type) {
            $query->where(function ($q) use ($request) {
                $q->where('sales_type', $request->sales_type)
                    ->orWhere('sales_type', 'both retail and wholesale');
            });
        }

        // Apply sales niche filter (organic/inorganic)
        if ($request->has('sales_niche') && $request->sales_niche) {
            $query->where('sales_niche', $request->sales_niche);
        }

        // Apply location filter
        if ($request->has('location') && $request->location) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }

        // Apply sorting
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Get unique locations for the location dropdown
        $locations = Product::select('location')
            ->distinct()
            ->pluck('location');

        // Paginate results
        $products = $query->paginate(12)->withQueryString();

        return view('products', compact('products', 'categories', 'locations'));
    }

    public function getCurrencies()
    {
        $currencies = [
            ['name' => 'US Dollar', 'code' => 'USD', 'sign' => '$'],
            ['name' => 'Euro', 'code' => 'EUR', 'sign' => '€'],
            ['name' => 'British Pound', 'code' => 'GBP', 'sign' => '£'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'sign' => '¥'],
            ['name' => 'Chinese Yuan', 'code' => 'CNY', 'sign' => '¥'],
            ['name' => 'Swiss Franc', 'code' => 'CHF', 'sign' => 'CHF'],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'sign' => 'C$'],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'sign' => 'A$'],
            ['name' => 'New Zealand Dollar', 'code' => 'NZD', 'sign' => 'NZ$'],
            ['name' => 'Indian Rupee', 'code' => 'INR', 'sign' => '₹'],
            ['name' => 'Nigerian Naira', 'code' => 'NGN', 'sign' => '₦'],
            ['name' => 'South African Rand', 'code' => 'ZAR', 'sign' => 'R'],
            ['name' => 'Kenyan Shilling', 'code' => 'KES', 'sign' => 'KSh'],
            ['name' => 'Ghanaian Cedi', 'code' => 'GHS', 'sign' => '₵'],
            ['name' => 'Egyptian Pound', 'code' => 'EGP', 'sign' => 'E£'],
            ['name' => 'Brazilian Real', 'code' => 'BRL', 'sign' => 'R$'],
            ['name' => 'Mexican Peso', 'code' => 'MXN', 'sign' => '$'],
            ['name' => 'Argentine Peso', 'code' => 'ARS', 'sign' => '$'],
            ['name' => 'Russian Ruble', 'code' => 'RUB', 'sign' => '₽'],
            ['name' => 'Turkish Lira', 'code' => 'TRY', 'sign' => '₺'],
            ['name' => 'Saudi Riyal', 'code' => 'SAR', 'sign' => '﷼'],
            ['name' => 'UAE Dirham', 'code' => 'AED', 'sign' => 'د.إ'],
            ['name' => 'Hong Kong Dollar', 'code' => 'HKD', 'sign' => 'HK$'],
            ['name' => 'Singapore Dollar', 'code' => 'SGD', 'sign' => 'S$'],
            ['name' => 'Malaysian Ringgit', 'code' => 'MYR', 'sign' => 'RM'],
            ['name' => 'Thai Baht', 'code' => 'THB', 'sign' => '฿'],
            ['name' => 'Indonesian Rupiah', 'code' => 'IDR', 'sign' => 'Rp'],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'sign' => '₱'],
            ['name' => 'Vietnamese Dong', 'code' => 'VND', 'sign' => '₫'],
            ['name' => 'South Korean Won', 'code' => 'KRW', 'sign' => '₩'],
            ['name' => 'Pakistani Rupee', 'code' => 'PKR', 'sign' => '₨'],
            ['name' => 'Bangladeshi Taka', 'code' => 'BDT', 'sign' => '৳'],
            ['name' => 'Israeli Shekel', 'code' => 'ILS', 'sign' => '₪'],
            ['name' => 'Norwegian Krone', 'code' => 'NOK', 'sign' => 'kr'],
            ['name' => 'Swedish Krona', 'code' => 'SEK', 'sign' => 'kr'],
            ['name' => 'Danish Krone', 'code' => 'DKK', 'sign' => 'kr'],
            ['name' => 'Polish Zloty', 'code' => 'PLN', 'sign' => 'zł'],
            ['name' => 'Czech Koruna', 'code' => 'CZK', 'sign' => 'Kč'],
            ['name' => 'Hungarian Forint', 'code' => 'HUF', 'sign' => 'Ft'],
            ['name' => 'Romanian Leu', 'code' => 'RON', 'sign' => 'lei'],
            ['name' => 'Bulgarian Lev', 'code' => 'BGN', 'sign' => 'лв'],
            ['name' => 'Croatian Kuna', 'code' => 'HRK', 'sign' => 'kn'],
            ['name' => 'Ukrainian Hryvnia', 'code' => 'UAH', 'sign' => '₴'],
            ['name' => 'Chilean Peso', 'code' => 'CLP', 'sign' => '$'],
            ['name' => 'Colombian Peso', 'code' => 'COP', 'sign' => '$'],
            ['name' => 'Peruvian Sol', 'code' => 'PEN', 'sign' => 'S/'],
            ['name' => 'Moroccan Dirham', 'code' => 'MAD', 'sign' => 'د.م.'],
            ['name' => 'Tanzanian Shilling', 'code' => 'TZS', 'sign' => 'TSh'],
            ['name' => 'Ugandan Shilling', 'code' => 'UGX', 'sign' => 'USh'],
            ['name' => 'Ethiopian Birr', 'code' => 'ETB', 'sign' => 'Br'],
            ['name' => 'West African CFA Franc', 'code' => 'XOF', 'sign' => 'CFA'],
            ['name' => 'Central African CFA Franc', 'code' => 'XAF', 'sign' => 'FCFA'],
        ];

        return $currencies;
    }


    public function create()
    {
        $categories = Category::all();
        $currencies = $this->getCurrencies();


        return view('products.create', compact('categories', 'currencies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Step 1: Basic Information
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sales_type' => 'required|in:wholesale,retail,both retail and wholesale',
            'sales_niche' => 'required|in:organic,inorganic',

            // Step 2: Pricing & Quantity
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string',
            'quantity_available' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'shipping' => 'required|in:local,international,both local and international',

            // Step 3: Product Media & Description
            'images' => 'required|array|min:3|max:5',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120', // 5MB
            'video_url' => 'nullable|url',
            'description' => 'required|string|min:10',
            'specifications' => 'required|string|min:10',
        ], [
            // Custom error messages
            'product_name.required' => 'Product name is required',
            'category_id.required' => 'Product category is required',
            'sales_type.required' => 'Sales type is required',
            'sales_niche.required' => 'Sales niche is required',
            'price.required' => 'Price per unit is required',
            'currency.required' => 'Currency is required',
            'quantity_available.required' => 'Quantity available is required',
            'location.required' => 'Location is required',
            'shipping.required' => 'Shipping option is required',
            'images.required' => 'Please upload 3-5 product images',
            'images.min' => 'Please upload at least 3 product images',
            'images.max' => 'You can upload a maximum of 5 product images',
            'images.*.image' => 'All files must be images',
            'images.*.mimes' => 'Images must be in JPEG, JPG, PNG, GIF, or WebP format',
            'images.*.max' => 'Each image must not exceed 5MB',
            'description.required' => 'Product description is required',
            'specifications.required' => 'Product specifications are required',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Store in public/products directory
                $path = $image->storeAs('products', $filename, 'public');

                // Add to array
                $imagePaths[] = $path;
            }
        }

        // Create product
        $product = Product::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'slug'     => substr(md5(uniqid(time(), true)), 0, 32),
            'product_name' => $validated['product_name'],
            'sales_type' => $validated['sales_type'],
            'sales_niche' => $validated['sales_niche'],
            'price' => $validated['price'],
            'currency' => $validated['currency'],
            'quantity_available' => $validated['quantity_available'],
            'location' => $validated['location'],
            'shipping' => $validated['shipping'],
            'images' => $imagePaths, // Will be automatically converted to JSON
            'video_link' => $validated['video_url'] ?? null,
            'description' => $validated['description'],
            'specifications' => $validated['specifications'],
            'status' => 'available',
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product published successfully!');
    }

    /**
     * Display the specified product (public view).
     */

    public function show($slug)
    {
        $product = Product::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related products (same category, exclude current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'available')
            ->latest()
            ->take(4)
            ->get();

        return view('products.product_detail', compact('product', 'relatedProducts'));
    }

    /**
     * Display the specified product (auth users).
     */

    public function single($slug)
    {
        $product = Product::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related products (same category, exclude current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'available')
            ->latest()
            ->take(4)
            ->get();

        return view('products.single', compact('product', 'relatedProducts'));
    }

    // deactivate a product
    public function deactivate(Product $product)
    {
        if (!auth()->user()->can('deactivate', $product)) {
            return back()->with('error', 'Unauthorized access!');
        }
        $data = [
            'status' => 'disabled',
        ];

        if ($product->update($data)) {
            return back()->with('success', 'Product deactivated successfully');
        }
    }
    // activate a product
    public function activate(Product $product)
    {
        
        if (!auth()->user()->can('activate', $product)) {
            return back()->with('error', 'Unauthorized access!');
        }
        $data = [
            'status' => 'available',
        ];

        if ($product->update($data)) {
            return back()->with('success', 'Product activated successfully');
        }
    }
    // mark a product unavailable
    public function unavailable(Product $product)
    {
        if (!auth()->user()->can('unavailable', $product)) {
            return back()->with('error', 'Unauthorized access!');
        }
        $data = [
            'status' => 'unavailable',
        ];

        if ($product->update($data)) {
            return back()->with('success', 'Product marked unavailable');
        }
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($slug)
    {
        $user = Auth::user();
        $product = Product::where('slug', $slug)
            ->where('user_id', $user->id)
            ->firstOrFail();
        // dd($product);
        if (!auth()->user()->can('update', $product)) {
            return back()->with('error', 'Unauthorized access!');
        }
        $categories = Category::all();
        $currencies = $this->getCurrencies(); // or however you get currencies

        return view('products.edit', compact('product', 'categories', 'currencies'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $slug)
    {
        $user = Auth::user();
        $product = Product::where('slug', $slug)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if (!auth()->user()->can('update', $product)) {
            return back()->with('error', 'Unauthorized access!');
        }
        $validated = $request->validate([
            // Step 1: Basic Information
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sales_type' => 'required|in:wholesale,retail,both retail and wholesale',
            'sales_niche' => 'required|in:organic,inorganic',

            // Step 2: Pricing & Quantity
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string',
            'quantity_available' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'shipping' => 'required|in:local,international,both local and international',
            'status' => 'required|in:available,unavailable,featured,disabled',

            // Step 3: Product Media & Description
            'images' => 'nullable|array|min:3|max:5',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120', // 5MB
            'video_link' => 'nullable|url',
            'description' => 'required|string|min:10',
            'specifications' => 'nullable|string|min:10',
        ], [
            // Custom error messages
            'product_name.required' => 'Product name is required',
            'category_id.required' => 'Product category is required',
            'sales_type.required' => 'Sales type is required',
            'sales_niche.required' => 'Sales niche is required',
            'price.required' => 'Price per unit is required',
            'currency.required' => 'Currency is required',
            'quantity_available.required' => 'Quantity available is required',
            'location.required' => 'Location is required',
            'shipping.required' => 'Shipping option is required',
            'status.required' => 'Product status is required',
            'images.min' => 'Please upload at least 3 product images',
            'images.max' => 'You can upload a maximum of 5 product images',
            'images.*.image' => 'All files must be images',
            'images.*.mimes' => 'Images must be in JPEG, JPG, PNG, GIF, or WebP format',
            'images.*.max' => 'Each image must not exceed 5MB',
            'description.required' => 'Product description is required',
            'specifications.min' => 'Product specifications must be at least 10 characters',
        ]);


        // Handle image uploads if new images provided
        if ($request->hasFile('images')) {
            // Get old images - it's already an array
            $oldImages = $product->images;

            // Delete old images from storage
            if (is_array($oldImages)) {
                foreach ($oldImages as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }

            // Handle new image uploads (same as store method)
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Store in public/products directory
                $path = $image->storeAs('products', $filename, 'public');

                // Add to array
                $imagePaths[] = $path;
            }

            // Update with new images
            $validated['images'] = $imagePaths; // Will be automatically converted to JSON
        } else {
            // Keep existing images if no new images uploaded
            unset($validated['images']);
        }

        // Update product
        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }
    /**
     * Remove the specified product from storage.
     */
    // public function destroy($slug)
    // {
    //     $product = Product::where('slug', $slug)
    //         ->where('user_id', auth()->id())
    //         ->firstOrFail();

    //     // Delete product images
    //     $images = json_decode($product->images, true);
    //     if (is_array($images)) {
    //         foreach ($images as $image) {
    //             \Storage::disk('public')->delete($image);
    //         }
    //     }

    //     $product->delete();

    //     return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    // }
}
