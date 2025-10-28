<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'vendor_id',
        'product_id',
        'service_id',
        'quote_id',
        'order_number',
        'product_details',
        'quantity',
        'unit',
        'unit_price',
        'total_amount',
        'status',
        'payment_status',
        'shipping_address',
        'billing_address',
        'tracking_number',
        'expected_delivery_date',
        'delivered_at',
        'notes',
        'attachments',
    ];

    protected $casts = [
        'product_details' => 'array',
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'expected_delivery_date' => 'date',
        'delivered_at' => 'date',
        'attachments' => 'array',
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}