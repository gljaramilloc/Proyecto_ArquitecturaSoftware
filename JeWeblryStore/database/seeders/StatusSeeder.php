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
            'Activo',
            'Inactivo',
            'Pendiente',
            'Aprobado',
            'Rechazado',
        ];

        foreach ($statuses as $statusName) {
            Status::firstOrCreate([
                'name' => $statusName,
            ]);
        }
    }
}
