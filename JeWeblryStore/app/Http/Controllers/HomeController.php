<?php

namespace App\Http\Controllers;

use App\Models\Jewel;
use App\Services\ExchangeRateService;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Inject the exchange rate service for storefront currency references.
     */
    public function __construct(private readonly ExchangeRateService $exchangeRateService) {}

    /**
     * Display the storefront home page with featured jewels and live exchange rate.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('home.title');
        $viewData['featuredJewels'] = Jewel::with(['status', 'category'])
            ->active()
            ->latest()
            ->take(6)
            ->get();
        $viewData['exchangeQuote'] = $this->exchangeRateService->getUsdToCopQuote();

        return view('home.index')->with('viewData', $viewData);
    }
}
