<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $quantity
 * @property float $unitPrice
 * @property int $jewelId
 * @property int $orderId
 * @property string $createdAt
 * @property string $updatedAt
 */
class OrderItem extends Model
{
    protected $fillable = [
        'quantity',
        'unit_price',
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
        return $this->unit_price;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unit_price = $unitPrice;
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

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    // No strict typing or ': void' to respect Laravel's inheritance
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    // No strict typing or ': void' to respect Laravel's inheritance
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    public static function getTopSold(int $limit = 3): Collection
    {
        return self::with('jewel')
            ->select('jewel_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('jewel_id')
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();
    }

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function jewel(): BelongsTo
    {
        return $this->belongsTo(Jewel::class);
    }

    public function getJewel(): ?Jewel
    {
        return $this->jewel;
    }

    public function setJewel(Jewel $jewel): void
    {
        $this->jewel = $jewel;
    }
}
