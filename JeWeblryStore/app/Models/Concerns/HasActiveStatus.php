<?php

namespace App\Models\Concerns;

use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;

/**
 * Shared between Category and Jewel: both need the same business rule
 * (checking whether they are "Active" and filtering only active records),
 * so it is delegated here instead of duplicating the method in each model.
 *
 * Requires the class using this trait to have a getStatus() method
 * (both models already have it, through their belongsTo(Status::class) relationship).
 */
trait HasActiveStatus
{
    /**
     * Must be implemented by the class using this trait.
     * Category and Jewel already define it further below in their own file.
     */
    abstract public function getStatus(): ?Status;

    public function isActive(): bool
    {
        return $this->getStatus()?->getName() === 'Active';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereHas('status', function (Builder $statusQuery) {
            $statusQuery->where('name', 'Active');
        });
    }
}
