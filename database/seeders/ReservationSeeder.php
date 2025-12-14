<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'title' => 'Fuji Experience',
                'badge' => 'Platinum',
                'duration' => '2.5 hours',
                'room' => 'Private Tatami Room A',
                'price' => 250000,
                'capacity' => 8,
                'menu' => 'Exclusive 9-course kaiseki menu, Premium sake pairing, Traditional tea ceremony, Seasonal delicacies',
                'image_path' => '/img/landingImage/restaurantInterior.png',
            ],
            [
                'title' => 'Sakura Dining',
                'badge' => 'Gold',
                'duration' => '2 hours',
                'room' => 'Garden View Room',
                'price' => 180000,
                'capacity' => 6,
                'menu' => '7-course kaiseki menu, Sake selection, Seasonal appetizers, Traditional desserts',
                'image_path' => '/img/landingImage/restaurantInterior.png',
            ],
            [
                'title' => 'Yuki Omakase',
                'badge' => 'Silver',
                'duration' => '1.5 hours',
                'room' => 'Main Dining Hall',
                'price' => 120000,
                'capacity' => 4,
                'menu' => '5-course omakase menu, House sake, Miso soup, Green tea',
                'image_path' => '/img/landingImage/restaurantInterior.png',
            ],
            [
                'title' => 'Matcha Ceremony',
                'badge' => 'Bronze',
                'duration' => '1 hour',
                'room' => 'Tea Room',
                'price' => 80000,
                'capacity' => 4,
                'menu' => 'Traditional matcha tea ceremony, Wagashi sweets, Light appetizers',
                'image_path' => '/img/landingImage/restaurantInterior.png',
            ],
            [
                'title' => 'Kaiseki Premium',
                'badge' => 'Platinum',
                'duration' => '3 hours',
                'room' => 'VIP Private Suite',
                'price' => 350000,
                'capacity' => 10,
                'menu' => '12-course premium kaiseki, Rare sake collection, Chef\'s special preparation, Personalized menu',
                'image_path' => '/img/landingImage/restaurantInterior.png',
            ],
            [
                'title' => 'Sushi Master Class',
                'badge' => 'Gold',
                'duration' => '2 hours',
                'room' => 'Sushi Bar Counter',
                'price' => 200000,
                'capacity' => 6,
                'menu' => 'Interactive sushi making, Premium nigiri selection, Sashimi platter, Chef guidance',
                'image_path' => '/img/landingImage/restaurantInterior.png',
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
