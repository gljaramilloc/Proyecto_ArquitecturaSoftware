<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;

class ToggleActiveStatusAction
{
    /**
     * Toggle the active status of a category or jewel.
     */
    public function execute(Category|Jewel $model): void
    {
        $activeStatus = Status::query()->where('name', 'Active')->firstOrFail();
        $inactiveStatus = Status::query()->where('name', 'Inactive')->firstOrFail();

        $newStatus = $model->getStatusId() === $activeStatus->getId()
            ? $inactiveStatus
            : $activeStatus;

        $model->setStatusId($newStatus->getId());
        $model->save();
    }
}
