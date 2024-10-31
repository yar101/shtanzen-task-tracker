<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'title' => $this->faker->sentence(),
                'body' => $this->faker->paragraph(),
                'status_id' => $this->faker->numberBetween(1, 5),
                'created_by' => 1,
                'cost' => $this->faker->numberBetween(500, 100000),
                'deadline_start' => now(),
                'deadline_end' => $this->faker->dateTime(),
                'currency' => 'RUB',
                'priority' => $this->faker->randomElement(['I', 'II', 'III']),
                'comment' => $this->faker->sentence(),
                'created_at' => now(),
                'parent_id' => null,
                'updated_by' => null,
                'updated_at' => null,
                'contractor_id' => 1,
                'department_id' => 2,
                'manager_id' => $this->faker->randomElement(User::all()->pluck('id')->toArray()),
        ];
    }
}
