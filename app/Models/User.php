<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'role',
        'name',
        'email',
        'phone',
        'password',
        'location',
        'business_name',
        'logo',
        'verification_documents',
        'verification_status',
        'service_category_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // In App\Models\User.php

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    // In App\Models\User.php

    public function chats() : BelongsToMany
    {
        // A user can belong to many chats (private or group)
        return $this->belongsToMany(Chat::class, 'chat_users')
            ->withPivot('last_message_id') // Tracks last read message
            ->withTimestamps();
    }

    public function messages() : HasMany
    {
        // A user can send many messages
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function savedProducts() : HasMany
    {
        return $this->hasMany(SavedProduct::class);
    }

    public function inquiriesSent() : HasMany
    {
        return $this->hasMany(Inquiry::class, 'buyer_id');
    }

    public function inquiriesReceived() : HasMany
    {
        return $this->hasMany(Inquiry::class, 'vendor_id');
    }

    public function quotesSent() : HasMany
    {
        return $this->hasMany(Quote::class, 'vendor_id');
    }

    public function quotesReceived() : HasMany
    {
        return $this->hasMany(Quote::class, 'buyer_id');
    }

    public function ordersPlaced() : HasMany
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function ordersReceived() : HasMany
    {
        return $this->hasMany(Order::class, 'vendor_id');
    }

    public function services() : HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}
