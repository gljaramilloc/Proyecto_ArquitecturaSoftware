<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;
=======
>>>>>>> f878abbd5d1234f3474909515ca46ee6cba8ea4c

/**
 * @property int $id
 * @property string $name
 * @property string $lastNames
 * @property string $email
 * @property string $phoneNumber
 * @property string $address
 * @property string $password
 * @property int $statusId
 * @property string $role
<<<<<<< HEAD
 * @property string $createdAt
 * @property string $updatedAt
=======
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
>>>>>>> f878abbd5d1234f3474909515ca46ee6cba8ea4c
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastNames',
        'email',
        'phoneNumber',
        'address',
        'password',
        'status_id', // Cambiado a llave foránea
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    public function getLastNames(): ?string
    {
        return $this->lastNames;
    }

    public function setLastNames(?string $lastNames): void
    {
        $this->lastNames = $lastNames;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
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

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
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

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function setOrders(Collection $orders): void
    {
        $this->orders = $orders;
    }
}
