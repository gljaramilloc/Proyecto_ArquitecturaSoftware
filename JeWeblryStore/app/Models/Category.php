<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property int $statusId
 * @property string $createdAt
 * @property string $updatedAt
 */
class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'status_id', // Cambiado de booleano a llave foránea
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
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

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    // Sin tipado estricto ni ': void' para respetar la herencia de Laravel
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    // Sin tipado estricto ni ': void' para respetar la herencia de Laravel
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

    public function jewels(): HasMany
    {
        return $this->hasMany(Jewel::class);
    }

    public function getJewels(): Collection
    {
        return $this->jewels;
    }

    public function setJewels(Collection $jewels): void
    {
        $this->jewels = $jewels;
    }
}