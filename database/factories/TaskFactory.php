<?php

namespace Database\Factories;

use App\Models\Contractor;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
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
        $usersCount = User::all()->count();
        $currencyVariants = ['RUB', 'USD', 'EUR', 'CNY'];
        $priorityVariants = ['I', 'II', 'III'];
        return [
                'title' => $this->faker->realText(30),
                'body' => $this->faker->realText(50),
                'status_id' => $this->faker->numberBetween(1, 5),
                'created_by' => $this->faker->numberBetween(1, $usersCount),
                'cost' => $this->faker->numberBetween(500, 100000),
                'deadline_start' => now(),
                'deadline_end' => $this->faker->dateTimeBetween(now(), Carbon::now()->addDays(30)),
                'currency' => $this->faker->randomElement($currencyVariants),
                'priority' => $this->faker->randomElement($priorityVariants),
                'created_at' => now(),
                'parent_id' => null,
                'updated_by' => null,
                'updated_at' => null,
                'contractor_id' => Contractor::all()->random()->id,
                'department_id' => 2,
                'manager_id' => $this->faker->numberBetween(1, $usersCount),
        ];
    }
}
