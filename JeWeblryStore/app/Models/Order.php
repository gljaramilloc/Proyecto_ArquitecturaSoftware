<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $status
 * @property float $total
 * @property int $userId
 * @property \Carbon\Carbon $createdAt
 * @property \Carbon\Carbon $updatedAt
 */
class Order extends Model
{
    protected $fillable = [
        'status',
        'total',
        'user_id',
    ];

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->created_at = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updated_at = $updatedAt;
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): void
    {
        $this->items = $items;
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }
}