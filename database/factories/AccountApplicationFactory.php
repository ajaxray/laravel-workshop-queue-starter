<?php

namespace Database\Factories;

use App\Stats\Submitted;
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
            'national_id' => $this->faker->unique()->numerify('##########'),
            'passport_number' => $this->faker->unique()->numerify('PP########'),
            'state' => Submitted::class,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($application) {
            // Attach a random photo from data/avatars
            $avatars = glob(base_path('data/avatars/*.jpg'));
            if ($avatars && count($avatars) > 0) {
                $photo = $avatars[array_rand($avatars)];
                $application->addMedia($photo)
                    ->preservingOriginal()
                    ->usingName('Photo')
                    ->toMediaCollection('photo', 'private');
            }

            // Attach 3 random documents from data/documents
            $documents = array_merge(
                glob(base_path('data/documents/*.pdf')),
                glob(base_path('data/documents/*.png')),
                glob(base_path('data/documents/*.jpg'))
            );
            if ($documents && count($documents) >= 3) {
                $selected = array_rand($documents, 3);
                foreach ((array)$selected as $docIndex) {
                    $application->addMedia($documents[$docIndex])
                        ->preservingOriginal()
                        ->toMediaCollection('documents', 'private');
                }
            }
        });
    }
}
