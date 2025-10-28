<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'product_name',
        'sales_type',
        'sales_niche',
        'price',
        'currency',
        'quantity_available',
        'location',
        'shipping',
        'images',
        'video_link',
        'description',
        'specifications',
        'status',
    ];

    protected $casts = [
        'images' => 'array', // Automatically cast JSON to array
        'price' => 'decimal:2',
        'quantity_available' => 'decimal:2',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
