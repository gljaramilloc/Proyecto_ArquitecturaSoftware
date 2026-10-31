<?php

namespace App\Actions;

use App\Models\Jewel;

class CreateJewelAction
{
    /**
     * Create a jewel from validated data.
     */
    public function execute(array $jewelData): Jewel
    {
        return Jewel::create($jewelData);
    }
}
