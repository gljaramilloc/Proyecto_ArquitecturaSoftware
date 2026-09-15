<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 */
class Status extends Model
{
    protected $fillable = [
        'name',
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
}