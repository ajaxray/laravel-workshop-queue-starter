<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountApplication>
 */
class AccountApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->date('Y-m-d', '-18 years'),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'region_state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'account_type' => $this->faker->randomElement(['Preferred Banking', 'Standard', 'Business']),
            'category' => $this->faker->randomElement(['Individual', 'Joint', 'Corporate']),
            'state' => 'pending',
        ];
    }
}
