<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
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
    'description' => $this->faker->paragraph(),
    'status' => 'todo',
    'due_date' => $this->faker->date(),
    'assigned_to_id' => User::inRandomOrder()->first()->id,
];
    }
}
