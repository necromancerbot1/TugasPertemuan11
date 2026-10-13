<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
    ];

    // ─── Relationships ───────────────────────────────────────────
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────
    // Hanya produk aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Produk dengan stok tersedia
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Filter berdasarkan kategori
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Produk termurah
    public function scopeCheapest($query)
    {
        return $query->orderBy('price', 'asc');
    }

    // Produk terpopuler (paling banyak di-order)
    public function scopePopular($query)
    {
        return $query->withCount('orderItems')->orderByDesc('order_items_count');
    }

    // ─── Accessors ───────────────────────────────────────────────
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }
}
