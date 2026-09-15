<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $statusId
 * @property float $total
 * @property int $userId
 * @property string $createdAt
 * @property string $updatedAt
 */
class Order extends Model
{
    protected $fillable = [
        'status_id',
        'total',
        'user_id',
    ];

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getStatusId(): int
    {
        return $this->status_id;
    }

    public function setStatusId(int $statusId): void
    {
        $this->status_id = $statusId;
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

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    // Without strict typing or ': void' to respect Laravel's inheritance
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    // Without strict typing or ': void' to respect Laravel's inheritance
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    // Relationships
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setItems(Collection $items): void
    {
        $this->items = $items;
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(Payment $payment): void
    {
        $this->payment = $payment;
    }
}