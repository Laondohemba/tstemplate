<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('about', [AppController::class, 'about'])->name('app.about');
Route::get('all-products', [ProductController::class, 'appProducts'])->name('app.products');
Route::get('services', [AppController::class, 'services'])->name('app.services');
Route::get('contact', [AppController::class, 'contact'])->name('app.contact');
Route::get('services/logistics', [AppController::class, 'logistics'])->name('services.logistics');
Route::get('services/warehousing', [AppController::class, 'warehousing'])->name('services.warehousing');
Route::get('services/quality', [AppController::class, 'quality'])->name('services.quality');
Route::get('services/export', [AppController::class, 'export'])->name('services.export');
Route::get('services/packaging', [AppController::class, 'packaging'])->name('services.packaging');
Route::get('services/equipment', [AppController::class, 'equipment'])->name('services.equipment');
Route::get('services/cooperative', [AppController::class, 'cooperative'])->name('services.cooperative');

// Public service routes
Route::get('service-providers', [ServiceController::class, 'publicIndex'])->name('service-providers.index');
Route::get('service-providers/{slug}', [ServiceController::class, 'show'])->name('service-providers.show');
Route::get('service-providers/category/{slug}', [ServiceController::class, 'category'])->name('service-providers.category');
Route::get('terms', [AppController::class, 'terms'])->name('app.terms');
Route::get('privacy', [AppController::class, 'privacy'])->name('app.privacy');

// Public product view route (using slug)
Route::get('products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Public vendor profile route
Route::get('vendor/{slug}', [UserController::class, 'vendorProfile'])->name('vendor.profile');

Route::middleware('guest')->group(function () {
    Route::get('signup', [AuthController::class, 'create'])->name('user.create');
    Route::post('signup', [AuthController::class, 'store'])->name('user.store');
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('user.login');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Product management routes (authenticated users only)
    Route::prefix('dashboard')->group(function () {
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/{slug}/show', [ProductController::class, 'single'])->name('products.single');

        Route::middleware('role:admin,vendor')->group(function () {
            Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('products', [ProductController::class, 'store'])->name('products.store');
            Route::get('products/{slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('products/{slug}', [ProductController::class, 'update'])->name('products.update');
            Route::patch('products/{product}/deactivate', [ProductController::class, 'deactivate'])->name('products.deactivate');
            Route::patch('products/{product}/activate', [ProductController::class, 'activate'])->name('products.activate');
            Route::patch('products/{product}/unavailable', [ProductController::class, 'unavailable'])->name('products.unavailable');
        });

        // Service Provider Management Routes (only for service providers)
        Route::middleware('service_provider')->group(function () {
            Route::get('services', [ServiceController::class, 'index'])->name('services.index');
            Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
            Route::post('services', [ServiceController::class, 'store'])->name('services.store');
            Route::get('services/{slug}/edit', [ServiceController::class, 'edit'])->name('services.edit');
            Route::put('services/{slug}', [ServiceController::class, 'update'])->name('services.update');
            Route::delete('services/{slug}', [ServiceController::class, 'destroy'])->name('services.destroy');
        });

        // Buyer Dashboard Routes
        Route::prefix('buyer')->group(function () {
            Route::get('dashboard', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');
            Route::get('explore-products', [BuyerController::class, 'exploreProducts'])->name('buyer.explore-products');
            Route::get('natural-resources', [BuyerController::class, 'naturalResources'])->name('buyer.natural-resources');
            Route::post('save-product/{product}', [BuyerController::class, 'saveProduct'])->name('buyer.save-product');
            Route::delete('unsave-product/{product}', [BuyerController::class, 'unsaveProduct'])->name('buyer.unsave-product');
            Route::get('saved-products', [BuyerController::class, 'savedProducts'])->name('buyer.saved-products');
            Route::get('profile', [BuyerController::class, 'profile'])->name('buyer.profile');
            Route::put('profile', [BuyerController::class, 'updateProfile'])->name('buyer.update-profile');
        });

        // Inquiry Routes
        Route::get('inquiries', [InquiryController::class, 'index'])->name('buyer.inquiries');
        Route::get('inquiries/create', [InquiryController::class, 'create'])->name('inquiries.create');
        Route::post('inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
        Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::post('inquiries/{inquiry}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond');
        Route::patch('inquiries/{inquiry}/close', [InquiryController::class, 'close'])->name('inquiries.close');
        Route::delete('inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Vendor Inquiry Management
        Route::get('vendor/inquiries', [InquiryController::class, 'vendorInquiries'])->name('vendor.inquiries');

        // Order Management Routes
        Route::get('orders', [OrderController::class, 'buyerOrders'])->name('buyer.orders');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
        Route::post('orders/create-from-quote/{quote}', [OrderController::class, 'createFromQuote'])->name('orders.create-from-quote');

        // Vendor Order Management
        Route::get('vendor/orders', [OrderController::class, 'vendorOrders'])->name('vendor.orders');
        Route::patch('vendor/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('vendor.orders.update-status');

        // Profile Management Routes
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/password', [ProfileController::class, 'showPasswordForm'])->name('profile.password');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
        Route::get('profile/verification', [ProfileController::class, 'verification'])->name('profile.verification');
        Route::post('profile/verification', [ProfileController::class, 'submitVerification'])->name('profile.submit-verification');

               // Support Routes
               Route::get('support', [ProfileController::class, 'support'])->name('support');
               Route::post('support', [ProfileController::class, 'submitSupport'])->name('support.submit');

               // Service Provider Routes
               Route::prefix('service-provider')->group(function () {
                   Route::get('dashboard', [ServiceProviderController::class, 'dashboard'])->name('service-provider.dashboard');
                   Route::get('requests', [ServiceProviderController::class, 'requests'])->name('service-provider.requests');
                   Route::get('orders', [ServiceProviderController::class, 'orders'])->name('service-provider.orders');
               });

               /**
                * ==============================
                * CHAT ROUTES (AUTHENTICATED USERS)
                * ==============================
                */
        Route::prefix('chats')->group(function () {
            // List all chats for the logged-in user
            Route::get('/', [ChatController::class, 'index'])->name('chats.index');

            // View a single chat and messages
            Route::get('{chat:slug}', [ChatController::class, 'show'])->name('chats.show');

            // Start a new chat with a user
            Route::post('start/{user}', [ChatController::class, 'start'])->name('chats.start');

            // Send a message (text or attachment)
            Route::post('{chat:slug}/message', [ChatController::class, 'sendMessage'])->name('chats.sendMessage');

            // Mark a message as read
            Route::post('{chat}/messages/read', [ChatController::class, 'markAsRead'])->name('chats.markAsRead');

        });

        // Notification Routes
        Route::prefix('notifications')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
            Route::post('{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
            Route::post('mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
            Route::get('unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
            Route::get('recent', [NotificationController::class, 'recent'])->name('notifications.recent');
            Route::delete('{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
        });
    });
});
