<?php

namespace App\DataTransferObjects;

/**
 * Product received from the allied team's JSON service.
 * It is not stored in our database, so it is a plain read-only object with getters.
 */
class AlliedProduct
{
    public function __construct(
        private readonly string $name,
        private readonly ?float $price,
        private readonly ?string $image,
        private readonly ?string $link,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }
}
