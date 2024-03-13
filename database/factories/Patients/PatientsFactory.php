<?php

namespace Database\Factories\Patients;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date,
            'age' => $this->faker->numberBetween(18, 60),
            'skin_type' => $this->faker->word,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'civil_status' => $this->faker->randomElement(['single', 'married', 'divorced']),
            'home_address' => $this->faker->address,
            'religion' => $this->faker->word,
            'contact_number' => $this->faker->phoneNumber,
            'account_status' => $this->faker->randomElement(['active', 'inactive']),
            'role' => 0,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
