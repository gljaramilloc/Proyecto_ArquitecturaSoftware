<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $description
 * @property int $statusId
 * @property int $stock
 * @property string $material
 * @property string $image
 * @property int $categoryId
 * @property string $createdAt
 * @property string $updatedAt
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
>>>>>>> f878abbd5d1234f3474909515ca46ee6cba8ea4c
 */
class Jewel extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'status_id', // Changed from 'status' to 'status_id'
        'stock',
        'material',
        'image',
        'category_id',
    ];

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    // Nuevo Getter y Setter para la llave foránea status_id
    public function getStatusId(): int
    {
        return $this->status_id;
    }

    public function setStatusId(int $statusId): void
    {
        $this->status_id = $statusId;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getMaterial(): string
    {
        return $this->material;
    }

    public function setMaterial(string $material): void
    {
        $this->material = $material;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->category_id = $categoryId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    // Corrected for Laravel inheritance
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    // Corrected for Laravel inheritance
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    // Relationships

    // Nueva relación con el modelo Status
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function setOrderItems(Collection $orderItems): void
    {
        $this->orderItems = $orderItems;
    }
}
