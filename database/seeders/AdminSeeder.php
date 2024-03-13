<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Marthea Daluyon',
            'username' => 'marthea123456789',
            'email'     => 'jhonericaton@gmail.com',
            'password'  => bcrypt('12345678'),
            'role'   => 1,
            'account_status' => 1,
            'first_name' => 'Marthea',
            'last_name' => 'Daluyon'
        ]);
    }
}
