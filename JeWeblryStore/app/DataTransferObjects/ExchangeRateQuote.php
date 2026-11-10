<?php

namespace App\DataTransferObjects;

/**
 * Immutable USD to COP exchange rate quote retrieved from the external API.
 */
class ExchangeRateQuote
{
    /**
     * Create an immutable exchange rate quote instance.
     */
    public function __construct(
        private readonly string $baseCurrency,
        private readonly string $targetCurrency,
        private readonly float $rate,
        private readonly ?string $updatedAtLabel = null,
    ) {}

    /**
     * Return the source currency ISO code.
     */
    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    /**
     * Return the target currency ISO code.
     */
    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    /**
     * Return the exchange rate value for one unit of the base currency.
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * Return the normalized publication date for the quote if provided.
     */
    public function getUpdatedAtLabel(): ?string
    {
        return $this->updatedAtLabel;
    }

    /**
     * Convert an amount from the base currency into the target currency.
     */
    public function convert(float $amount): float
    {
        return round($amount * $this->rate, 0);
    }
}
