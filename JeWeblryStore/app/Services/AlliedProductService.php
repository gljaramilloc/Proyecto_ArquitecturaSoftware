<?php

namespace App\Services;

use App\DataTransferObjects\AlliedProduct;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Consumes the JSON service published by the allied team.
 * The URL is configured with ALLIED_SERVICE_URL (config/services.php).
 */
class AlliedProductService
{
    // Accepted keys for each field, since the allied team may answer in English or Spanish
    private const NAME_KEYS = ['name', 'nombre', 'title', 'titulo'];

    private const PRICE_KEYS = ['price', 'precio'];

    private const IMAGE_KEYS = ['image', 'imagen', 'image_url', 'img'];

    private const LINK_KEYS = ['link', 'enlace', 'url'];

    /**
     * @return array<int, AlliedProduct>|null null when the service is not configured or does not respond
     */
    public function getProducts(): ?array
    {
        $serviceUrl = config('services.allied_store.url');

        if (empty($serviceUrl)) {
            return null;
        }

        try {
            $response = Http::acceptJson()
                ->timeout((int) config('services.allied_store.timeout'))
                ->get($serviceUrl)
                ->throw();
        } catch (ConnectionException|RequestException $exception) {
            Log::warning('Allied service is not available.', ['message' => $exception->getMessage()]);

            return null;
        }

        $rawProducts = $response->json('data') ?? $response->json();

        if (! is_array($rawProducts)) {
            return null;
        }

        $alliedProducts = [];
        foreach ($rawProducts as $rawProduct) {
            if (! is_array($rawProduct)) {
                continue;
            }

            $name = $this->firstValue($rawProduct, self::NAME_KEYS);
            if ($name === null) {
                continue;
            }

            $price = $this->firstValue($rawProduct, self::PRICE_KEYS);

            $alliedProducts[] = new AlliedProduct(
                (string) $name,
                is_numeric($price) ? (float) $price : null,
                $this->firstValue($rawProduct, self::IMAGE_KEYS),
                $this->firstValue($rawProduct, self::LINK_KEYS),
            );
        }

        return $alliedProducts;
    }

    // Returns the value of the first key present in the raw product, or null
    private function firstValue(array $rawProduct, array $keys): mixed
    {
        foreach ($keys as $key) {
            if (isset($rawProduct[$key]) && $rawProduct[$key] !== '') {
                return $rawProduct[$key];
            }
        }

        return null;
    }
}
