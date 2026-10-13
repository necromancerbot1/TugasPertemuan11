<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ─── Relationships ───────────────────────────────────────────
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ─── Helper Methods ──────────────────────────────────────────
    public function hasRole(string $role): bool
    {
        return $this->role?->name === $role;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    public function isUser(): bool
    {
        return $this->hasRole('user');
    }

    // ─── Scopes ──────────────────────────────────────────────────
    public function scopeAdmins($query)
    {
        return $query->whereHas('role', fn($q) => $q->where('name', 'admin'));
    }

    public function scopeEditors($query)
    {
        return $query->whereHas('role', fn($q) => $q->where('name', 'editor'));
    }

    public function scopeRegularUsers($query)
    {
        return $query->whereHas('role', fn($q) => $q->where('name', 'user'));
    }
}
