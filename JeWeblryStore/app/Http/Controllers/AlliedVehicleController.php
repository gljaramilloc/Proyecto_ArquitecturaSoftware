<?php

namespace App\Http\Controllers;

use App\Services\AlliedVehicleService;
use Illuminate\View\View;

class AlliedVehicleController extends Controller
{
    /**
     * Inject the service that consumes the allied team's JSON.
     */
    public function __construct(private readonly AlliedVehicleService $alliedVehicleService) {}

    /**
     * Show the rental vehicles published by the allied team's JSON service.
     */
    public function index(): View
    {
        $alliedVehicles = $this->alliedVehicleService->getVehicles();

        $viewData = [];
        $viewData['title'] = __('allied.title');
        $viewData['vehicles'] = $alliedVehicles ?? [];
        $viewData['serviceAvailable'] = $alliedVehicles !== null;

        return view('allied-vehicles.index')->with('viewData', $viewData);
    }
}
