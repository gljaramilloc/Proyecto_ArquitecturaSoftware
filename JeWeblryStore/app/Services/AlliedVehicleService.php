<?php

namespace App\Services;

use App\DataTransferObjects\AlliedVehicle;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Consumes the vehicle rental JSON service published by the allied team.
 * The URL is configured with ALLIED_SERVICE_URL (config/services.php).
 */
class AlliedVehicleService
{
    /**
     * @return array<int, AlliedVehicle>|null null when the service is not configured or does not respond
     */
    public function getVehicles(): ?array
    {
        $serviceUrl = config('services.allied_vehicles.url');

        if (empty($serviceUrl)) {
            return null;
        }

        try {
            $response = Http::acceptJson()
                ->timeout((int) config('services.allied_vehicles.timeout'))
                ->get($serviceUrl)
                ->throw();
        } catch (ConnectionException|RequestException $exception) {
            Log::warning('Allied service is not available.', ['message' => $exception->getMessage()]);

            return null;
        }

        $rawVehicles = $response->json('data');

        if (! is_array($rawVehicles)) {
            return null;
        }

        $alliedVehicles = [];
        foreach ($rawVehicles as $rawVehicle) {
            if (! is_array($rawVehicle) || empty($rawVehicle['make']) || empty($rawVehicle['model'])) {
                continue;
            }

            $location = is_array($rawVehicle['location'] ?? null) ? $rawVehicle['location'] : [];
            $dailyRate = $rawVehicle['daily_rate'] ?? null;

            $alliedVehicles[] = new AlliedVehicle(
                (int) ($rawVehicle['id'] ?? 0),
                (string) $rawVehicle['make'],
                (string) $rawVehicle['model'],
                $rawVehicle['category'] ?? null,
                $location['name'] ?? null,
                $location['city'] ?? null,
                is_numeric($dailyRate) ? (float) $dailyRate : null,
                $rawVehicle['currency'] ?? null,
                (bool) ($rawVehicle['availability'] ?? false),
                $rawVehicle['detail_url'] ?? null,
            );
        }

        return $alliedVehicles;
    }
}
