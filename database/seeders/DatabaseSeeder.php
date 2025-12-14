<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@daichino.com', // Email khusus admin
            'phone' => '081234567890',
            'password' => bcrypt('admindaichino123'), // Password admin
            'role' => 'admin',
        ]);

        // Seed reservation offers
        $this->call([
            ReservationSeeder::class,
        ]);
    }
}
