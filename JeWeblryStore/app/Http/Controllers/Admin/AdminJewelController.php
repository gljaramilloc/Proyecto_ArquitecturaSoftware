<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\TogglesActiveStatus;
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
    use TogglesActiveStatus;

    public function __construct(private readonly ImageUploadService $imageUploadService) {}

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.manage_jewels');
        $viewData['jewels'] = Jewel::with(['status', 'category'])->get();

        return view('admin.jewels.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.create_jewel');
        $viewData['statuses'] = Status::all();
        $viewData['categories'] = Category::all();

        return view('admin.jewels.create')->with('viewData', $viewData);
    }

    public function store(StoreJewelRequest $request): RedirectResponse
    {
        $jewelData = $request->validated();

        if ($request->hasFile('image')) {
            $jewelData['image'] = $this->imageUploadService->upload($request->file('image'), 'jewels');
        }

        Jewel::create($jewelData);

        return redirect()->route('admin.jewels.index')->with('status', __('admin.jewel_created'));
    }

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

    public function update(UpdateJewelRequest $request, int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);
        $jewelData = $request->validated();

        if ($request->hasFile('image')) {
            $this->imageUploadService->delete($jewel->getImage());
            $jewelData['image'] = $this->imageUploadService->upload($request->file('image'), 'jewels');
        }

        $jewel->update($jewelData);

        return redirect()->route('admin.jewels.index')->with('status', __('admin.jewel_updated'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);
        $this->imageUploadService->delete($jewel->getImage());
        $jewel->delete();

        return redirect()->route('admin.jewels.index')->with('status', __('admin.jewel_deleted'));
    }

    public function toggleStatus(int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);

        return $this->toggleModelStatus($jewel, 'admin.jewels.index');
    }
}
