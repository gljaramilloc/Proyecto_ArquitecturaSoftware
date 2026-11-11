<?php

namespace App\DataTransferObjects;

/**
 * Rental vehicle received from the allied team's JSON service.
 * It is not stored in our database, so it is a plain read-only object with getters.
 */
class AlliedVehicle
{
    public function __construct(
        private readonly int $id,
        private readonly string $make,
        private readonly string $model,
        private readonly ?string $category,
        private readonly ?string $locationName,
        private readonly ?string $city,
        private readonly ?float $dailyRate,
        private readonly ?string $currency,
        private readonly bool $available,
        private readonly ?string $detailUrl,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getFullName(): string
    {
        return $this->make.' '.$this->model;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getLocationName(): ?string
    {
        return $this->locationName;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getDailyRate(): ?float
    {
        return $this->dailyRate;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getDetailUrl(): ?string
    {
        return $this->detailUrl;
    }
}
