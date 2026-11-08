<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JewelResource;
use App\Models\Jewel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class JewelApiController extends Controller
{
    /**
     * List the active jewels in stock as JSON for the partner team.
     */
    public function index(): JsonResponse
    {
        $jewels = Jewel::where('stock', '>', 0)
            ->whereHas('status', function (Builder $statusQuery) {
                $statusQuery->where('name', 'Active');
            })
            ->get();

        return response()->json(JewelResource::collection($jewels), 200);
    }
}
