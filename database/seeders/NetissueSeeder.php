<?php

namespace Database\Seeders;

use App\Models\NetIssue;
use Illuminate\Database\Seeder;

class NetIssueSeeder extends Seeder
{
    public function run(): void
    {
        $issues = [
            ['name' => 'Fiber Cut', 'description' => 'Physical fiber optic cable damage'],
            ['name' => 'Power Outage', 'description' => 'Site lost electrical power'],
            ['name' => 'Router Down', 'description' => 'Router unresponsive or offline'],
            ['name' => 'Hardware Failure', 'description' => 'Network equipment malfunction'],
            ['name' => 'Configuration Error', 'description' => 'Misconfigured network settings'],
        ];

        foreach ($issues as $issue) {
            NetIssue::updateOrCreate(['name' => $issue['name']], $issue);
        }
    }
}