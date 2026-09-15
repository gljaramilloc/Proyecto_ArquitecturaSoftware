<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Active',
            'Inactive',
            'Pending',
            'Approved',
            'Rejected',
        ];

        foreach ($statuses as $statusName) {
            Status::firstOrCreate([
                'name' => $statusName,
            ]);
        }
    }
}
