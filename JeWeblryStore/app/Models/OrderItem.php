<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $quantity
 * @property float $unitPrice
 * @property int $jewelId
 * @property int $orderId
 * @property \Carbon\Carbon $createdAt
 * @property \Carbon\Carbon $updatedAt
 */
class OrderItem extends Model
{
    protected $fillable = [
        'quantity',
        'unitPrice',
        'jewel_id',
        'order_id',
    ];

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getJewelId(): int
    {
        return $this->jewel_id;
    }

    public function setJewelId(int $jewelId): void
    {
        $this->jewel_id = $jewelId;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function setOrderId(int $orderId): void
    {
        $this->order_id = $orderId;
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
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order): void
    {
        $this->order = $order;
    }

    public function jewel(): BelongsTo
    {
        return $this->belongsTo(Jewel::class);
    }

    public function getJewel()
    {
        return $this->jewel;
    }

    public function setJewel($jewel): void
    {
        $this->jewel = $jewel;
    }
}