<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=queues>
 */
class QueueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 3,
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => '08' . rand(1000000000, 9999999999),
            'address' => fake()->address(),
            'queue_date' => Carbon::now()->format('Y-m-d')
        ];
    }
}
