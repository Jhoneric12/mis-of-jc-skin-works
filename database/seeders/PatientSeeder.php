<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $plainPassword = $faker->password;

            User::create([
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make($plainPassword),
                'first_name' => $faker->firstName,
                'middle_name' => $faker->optional()->firstName,
                'last_name' => $faker->lastName,
                'name' => $faker->name,
                'birth_date' => $faker->date,
                'age' => $faker->numberBetween(18, 65),
                'skin_type' => $faker->optional()->word,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
                'home_address' => $faker->address,
                'religion' => $faker->optional()->word,
                'contact_number' => $faker->phoneNumber,
                'account_status' => $faker->randomElement([true, false]),
                'role' => 0, // Set role to 0
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
