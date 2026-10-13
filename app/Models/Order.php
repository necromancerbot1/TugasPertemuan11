<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_code',
        'total_price',
        'status',
        'shipping_address',
    ];

    // ─── Relationships ───────────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    // ─── Accessors ───────────────────────────────────────────────
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'bg-yellow-500/20 text-yellow-400',
            'processing' => 'bg-blue-500/20 text-blue-400',
            'shipped'    => 'bg-indigo-500/20 text-indigo-400',
            'delivered'  => 'bg-green-500/20 text-green-400',
            'cancelled'  => 'bg-red-500/20 text-red-400',
            default      => 'bg-gray-500/20 text-gray-400',
        };
    }
}
