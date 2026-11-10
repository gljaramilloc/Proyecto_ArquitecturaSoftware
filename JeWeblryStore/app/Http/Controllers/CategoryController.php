<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jewel;
use App\Services\ExchangeRateService;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Inject the exchange rate service for category jewel listings.
     */
    public function __construct(private readonly ExchangeRateService $exchangeRateService) {}

    /**
     * List the active categories for the storefront.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('catalog.categories_title');
        $viewData['categories'] = Category::with('status')->active()->orderBy('name')->get();

        return view('categories.index')->with('viewData', $viewData);
    }

    /**
     * Show an active category and its active jewels with COP conversion.
     */
    public function show(int $id): View
    {
        $category = Category::with('status')->active()->findOrFail($id);

        $viewData = [];
        $viewData['title'] = $category->getName();
        $viewData['category'] = $category;
        $viewData['jewels'] = Jewel::with(['status', 'category'])
            ->active()
            ->search(null, $category->getId())
            ->paginate(9);
        $viewData['exchangeQuote'] = $this->exchangeRateService->getUsdToCopQuote();

        return view('categories.show')->with('viewData', $viewData);
    }
}
