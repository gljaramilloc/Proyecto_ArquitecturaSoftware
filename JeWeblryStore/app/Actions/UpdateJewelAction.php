<?php

namespace App\Actions;

use App\Models\Jewel;

class UpdateJewelAction
{
    /**
     * Update a jewel with validated data.
     */
    public function execute(Jewel $jewel, array $jewelData): Jewel
    {
        $jewel->update($jewelData);

        return $jewel;
    }
}
