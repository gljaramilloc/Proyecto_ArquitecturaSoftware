<?php

namespace App\Http\Controllers;

use App\Services\AlliedProductService;
use Illuminate\View\View;

class AlliedProductController extends Controller
{
    /**
     * Inject the service that consumes the allied team's JSON.
     */
    public function __construct(private readonly AlliedProductService $alliedProductService) {}

    /**
     * Show the products published by the allied team's JSON service.
     */
    public function index(): View
    {
        $alliedProducts = $this->alliedProductService->getProducts();

        $viewData = [];
        $viewData['title'] = __('allied.title');
        $viewData['products'] = $alliedProducts ?? [];
        $viewData['serviceAvailable'] = $alliedProducts !== null;

        return view('allied-products.index')->with('viewData', $viewData);
    }
}
