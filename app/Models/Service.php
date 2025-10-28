<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'service_category_id',
        'company_name',
        'slug',
        'description',
        'contact_person',
        'email',
        'phone',
        'address',
        'location',
        'coverage_area',
        'services_offered',
        'images',
        'website',
        'rating',
        'reviews_count',
        'verification_status',
        'verification_badge',
        'status',
    ];

    protected $casts = [
        'services_offered' => 'array',
        'images' => 'array',
        'rating' => 'decimal:2',
        'reviews_count' => 'integer',
    ];

    /**
     * Get the user (service provider) that owns the service.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the service belongs to.
     */
    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include verified services.
     */
    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'verified');
    }
}
