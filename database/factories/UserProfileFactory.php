<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'middle_initial' => strtoupper(fake()->randomLetter()),
            'other_last_names' => fake()->optional()->lastName(),
            // Contact & Address
            'street_address' => fake()->streetAddress(),
            'apt' => fake()->optional()->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(), // 2 characters
            'zip' => fake()->postcode(),
            // Identification
            'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
            'ssn' => fake()->numerify('###-##-####'),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            // Status & Legal
            'status' => fake()->randomElement([
                'U.S. Citizen', 
                'Noncitizen National', 
                'Lawful Permanent Resident', 
                'Alien Authorized to Work'
            ]),
            'uscis_a_number' => fake()->optional()->numerify('#########'), // 9 digits
            'i94_admission_number' => fake()->optional()->numerify('###########'), // 11 digits
            'passport_number' => fake()->optional()->bothify('??######'),
            'passport_country' => fake()->optional()->country(),
            'work_authorization_expiration' => fake()->optional()->dateTimeBetween('+1 year', '+5 years'),
        ];
    }
}
