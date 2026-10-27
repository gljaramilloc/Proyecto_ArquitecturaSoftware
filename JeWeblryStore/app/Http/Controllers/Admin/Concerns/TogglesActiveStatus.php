<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

trait TogglesActiveStatus
{
    /**
     * Toggle a model's active status and redirect to the given route.
     */
    protected function toggleModelStatus(Model $model, string $redirectRoute): RedirectResponse
    {
        $activeStatus = Status::query()->where('name', 'Active')->first();
        $inactiveStatus = Status::query()->where('name', 'Inactive')->first();

        $currentStatusId = method_exists($model, 'getStatusId') ? $model->getStatusId() : null;

        $newStatus = ($activeStatus && $currentStatusId === $activeStatus->getId())
            ? $inactiveStatus
            : $activeStatus;

        if ($newStatus !== null && method_exists($model, 'setStatusId')) {
            $model->setStatusId($newStatus->getId());
            $model->save();
        }

        return redirect()->route($redirectRoute)->with('status', __('admin.status_updated'));
    }
}
