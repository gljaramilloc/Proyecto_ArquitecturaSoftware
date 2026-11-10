<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateJewelAction;
use App\Actions\ToggleActiveStatusAction;
use App\Actions\UpdateJewelAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJewelRequest;
use App\Http\Requests\UpdateJewelRequest;
use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminJewelController extends Controller
{
    /**
     * Create the controller with its jewel actions and image upload service.
     */
    public function __construct(
        private readonly ImageUploadService $imageUploadService,
        private readonly CreateJewelAction $createJewelAction,
        private readonly UpdateJewelAction $updateJewelAction,
        private readonly ToggleActiveStatusAction $toggleActiveStatusAction,
    ) {}

    /**
     * Display the list of jewels for administration.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.manage_jewels');
        $viewData['jewels'] = Jewel::with(['status', 'category'])->latest()->paginate(10);

        return view('admin.jewels.index')->with('viewData', $viewData);
    }

    /**
     * Display the form for creating a jewel.
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.create_jewel');
        $viewData['statuses'] = Status::all();
        $viewData['categories'] = Category::all();

        return view('admin.jewels.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created jewel.
     */
    public function store(StoreJewelRequest $request): RedirectResponse
    {
        $jewelData = $request->validated();

        if ($request->hasFile('image')) {
            $jewelData['image'] = $this->imageUploadService->upload($request->file('image'), 'jewels');
        }

        $this->createJewelAction->execute($jewelData);

        return redirect()->route('admin.jewels.index')->with('status', __('admin.jewel_created'));
    }

    /**
     * Display the form for editing a jewel.
     */
    public function edit(int $id): View
    {
        $jewel = Jewel::findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('admin.edit_jewel');
        $viewData['jewel'] = $jewel;
        $viewData['statuses'] = Status::all();
        $viewData['categories'] = Category::all();

        return view('admin.jewels.edit')->with('viewData', $viewData);
    }

    /**
     * Update an existing jewel and safely replace its image when uploaded.
     */
    public function update(UpdateJewelRequest $request, int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);
        $jewelData = $request->validated();
        $previousImage = null;

        if ($request->hasFile('image')) {
            $previousImage = $jewel->getImage();
            $jewelData['image'] = $this->imageUploadService->upload($request->file('image'), 'jewels');
        } else {
            unset($jewelData['image']);
        }

        $this->updateJewelAction->execute($jewel, $jewelData);

        if ($previousImage !== null && Jewel::where('image', $previousImage)->where('id', '!=', $jewel->getId())->doesntExist()) {
            $this->imageUploadService->delete($previousImage);
        }

        return redirect()->route('admin.jewels.index')->with('status', __('admin.jewel_updated'));
    }

    /**
     * Delete a jewel when no order items reference it and clean up unshared images.
     */
    public function destroy(int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);

        if ($jewel->orderItems()->exists()) {
            return redirect()
                ->route('admin.jewels.index')
                ->with('error', __('admin.cannot_delete_jewel_with_orders'));
        }

        $imagePath = $jewel->getImage();
        $jewel->delete();

        if ($imagePath !== '' && Jewel::where('image', $imagePath)->doesntExist()) {
            $this->imageUploadService->delete($imagePath);
        }

        return redirect()->route('admin.jewels.index')->with('status', __('admin.jewel_deleted'));
    }

    /**
     * Toggle the active status of a jewel.
     */
    public function toggleStatus(int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);
        $this->toggleActiveStatusAction->execute($jewel);

        return redirect()->route('admin.jewels.index')->with('status', __('admin.status_updated'));
    }
}
