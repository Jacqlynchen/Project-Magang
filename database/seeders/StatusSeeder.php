<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['code' => 'active', 'name' => 'Active'],
            ['code' => 'inactive', 'name' => 'Inactive'],
            ['code' => 'pending', 'name' => 'Pending'],
            ['code' => 'maintenance', 'name' => 'Maintenance'],
            ['code' => 'decommissioned', 'name' => 'Decommissioned'],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(
                ['code' => $status['code']],
                $status
            );
        }
    }
}