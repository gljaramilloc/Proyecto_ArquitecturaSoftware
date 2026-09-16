<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;

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

    // Colecciones aisladas para no ensuciar el Controller con Queries Eloquent puras (Fat Model, Thin Controller)
    public static function getByUser(int $userId): Collection
    {
        return self::with('status')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public static function getByIdAndUser(int $orderId, int $userId): self
    {
        return self::with('items.jewel')->where('user_id', $userId)->findOrFail($orderId);
    }

    public static function processPurchase(array $cartSession, int $userId): self
    {
        if (empty($cartSession)) {
            throw new \Exception(__('cart.empty_cart_error', ['default' => 'Cart is empty']));
        }

        $details = self::calculateCartDetails($cartSession);
        $total = $details['total'];
        $jewelsInSession = $details['jewels'];

        $order = new self;
        $order->setUserId($userId);
        $order->setTotal($total);

        $status = Status::where('name', 'Pendiente')->first();
        $order->setStatusId($status ? $status->getId() : 1);
        $order->save();

        $orderItems = [];
        foreach ($jewelsInSession as $jewel) {
            $quantity = $cartSession[$jewel->getId()];

            $orderItem = new OrderItem;
            $orderItem->setQuantity($quantity);
            $orderItem->setUnitPrice($jewel->getPrice());
            $orderItem->setJewelId($jewel->getId());
            $orderItems[] = $orderItem;

            $jewel->setStock($jewel->getStock() - $quantity);
            $jewel->save();
        }

        $order->items()->saveMany($orderItems);

        return $order;
    }

    public static function addJewelToCartSession(array $cartSession, string $id): array
    {
        $jewel = Jewel::find($id);

        if (! $jewel) {
            throw new \Exception(__('cart.jewel_not_exist'));
        }

        $currentQuantity = $cartSession[$id] ?? 0;
        $requestedQuantity = $currentQuantity + 1;

        if ($requestedQuantity > $jewel->getStock()) {
            throw new \Exception(__('cart.not_enough_stock'));
        }

        $cartSession[$id] = $requestedQuantity;

        return $cartSession;
    }

    public static function calculateCartDetails(array $cartSession): array
    {
        $total = 0;
        $jewelsInCart = [];

        if (! empty($cartSession)) {
            $jewelsInCart = Jewel::findMany(array_keys($cartSession));

            foreach ($jewelsInCart as $jewel) {
                $quantity = $cartSession[$jewel->getId()];
                $total += $jewel->getPrice() * $quantity;
            }
        }

        return [
            'jewels' => $jewelsInCart,
            'total' => $total,
        ];
    }

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
