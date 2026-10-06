<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        $branchCode = Branch::whereNotNull('code')
            ->where('code', '!=', '')
            ->inRandomOrder()
            ->value('code');

        return [
            'nik' => $this->faker->unique()->numerify('EMP#######'),
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('08##########'),
            'position_id' => $this->faker->numberBetween(1, 5),
            'position_title' => $this->faker->randomElement([
                'Teknisi Lapangan',
                'Insinyur Jaringan',
                'Supervisor Site',
                'Staf Pendukung',
                'Operator NOC',
            ]),
            'branch_code' => $branchCode ?? 'BR000',
        ];
    }
}