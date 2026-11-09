<?php

namespace App\Services;

use App\DataTransferObjects\ExchangeRateQuote;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Consumes the public USD to COP exchange rate (TRM) API with caching and fallback safety.
 */
class ExchangeRateService
{
    private const CACHE_KEY = 'exchange_rate.usd_cop_quote';

    private const FAILURE_SENTINEL = 'unavailable';

    private const FAILURE_COOLDOWN_SECONDS = 60;

    /**
     * Retrieve the current USD to COP exchange rate quote or null when unavailable.
     */
    public function getUsdToCopQuote(): ?ExchangeRateQuote
    {
        $serviceUrl = (string) config('services.exchange_rate.url', '');

        if ($serviceUrl === '') {
            return null;
        }

        $cacheTtl = (int) config('services.exchange_rate.cache_ttl', 3600);

        if ($cacheTtl > 0) {
            $cachedQuote = Cache::get(self::CACHE_KEY);
            if ($cachedQuote instanceof ExchangeRateQuote) {
                return $cachedQuote;
            }
            if ($cachedQuote === self::FAILURE_SENTINEL) {
                return null;
            }
        }

        try {
            $response = Http::acceptJson()
                ->timeout((int) config('services.exchange_rate.timeout', 5))
                ->get($serviceUrl)
                ->throw();
        } catch (ConnectionException|RequestException|Throwable $exception) {
            Log::warning('Exchange rate service is not available.', ['message' => $exception->getMessage()]);
            $this->rememberTemporaryFailure($cacheTtl);

            return null;
        }

        $payload = $response->json();

        if (! is_array($payload)) {
            $this->rememberTemporaryFailure($cacheTtl);

            return null;
        }

        $copRate = $this->extractCopRate($payload);

        if ($copRate === null) {
            $this->rememberTemporaryFailure($cacheTtl);

            return null;
        }

        $quote = new ExchangeRateQuote(
            baseCurrency: 'USD',
            targetCurrency: 'COP',
            rate: $copRate,
            updatedAtLabel: $this->extractUpdatedDate($payload),
        );

        if ($cacheTtl > 0) {
            Cache::put(self::CACHE_KEY, $quote, now()->addSeconds($cacheTtl));
        }

        return $quote;
    }

    /**
     * Cache a short-lived failure marker to prevent repeated timeouts on every page view.
     */
    private function rememberTemporaryFailure(int $cacheTtl): void
    {
        if ($cacheTtl > 0) {
            $cooldown = min($cacheTtl, self::FAILURE_COOLDOWN_SECONDS);
            Cache::put(self::CACHE_KEY, self::FAILURE_SENTINEL, now()->addSeconds($cooldown));
        }
    }

    /**
     * Extract a positive numeric COP rate from the decoded JSON payload.
     */
    private function extractCopRate(array $payload): ?float
    {
        $candidate = $payload['rates']['COP']
            ?? $payload['conversion_rates']['COP']
            ?? ($payload[0]['valor'] ?? null);

        if (! is_numeric($candidate)) {
            return null;
        }

        $rate = (float) $candidate;

        return $rate > 0 ? round($rate, 2) : null;
    }

    /**
     * Extract a clean YYYY-MM-DD date string from the API payload when available.
     */
    private function extractUpdatedDate(array $payload): ?string
    {
        $rawTimestamp = $payload['time_last_update_utc']
            ?? $payload['date']
            ?? ($payload[0]['vigenciadesde'] ?? null);

        if (! is_string($rawTimestamp) || trim($rawTimestamp) === '') {
            return null;
        }

        try {
            return Carbon::parse($rawTimestamp)->format('Y-m-d');
        } catch (Throwable) {
            return null;
        }
    }
}
