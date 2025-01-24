<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\TravelSchedule;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat user admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin', // Admin role
        ]);

        // Membuat beberapa user penumpang
        User::create([
            'name' => 'Customer User 1',
            'email' => 'customer1@example.com',
            'password' => Hash::make('user1231'),
            'role' => 'customer', // customer role
        ]);

        User::create([
            'name' => 'Customer User 2',
            'email' => 'customer2@example.com',
            'password' => Hash::make('user1232'),
            'role' => 'customer', // customer role
        ]);

        // Membuat beberapa travel schedule
        TravelSchedule::create([
            'destination' => 'Bali',
            'departure_date' => '2025-02-01',
            'departure_time' => '08:00:00',
            'quota' => 10,
            'ticket_price' => 500000,
        ]);

        TravelSchedule::create([
            'destination' => 'Yogyakarta',
            'departure_date' => '2025-02-02',
            'departure_time' => '09:00:00',
            'quota' => 8,
            'ticket_price' => 300000,
        ]);

        TravelSchedule::create([
            'destination' => 'Surabaya',
            'departure_date' => '2025-02-03',
            'departure_time' => '10:00:00',
            'quota' => 15,
            'ticket_price' => 400000,
        ]);

        // Membuat booking untuk penumpang pertama
        $user1 = User::where('email', 'customer1@example.com')->first();
        $schedule1 = TravelSchedule::where('destination', 'Bali')->first();

        Booking::create([
            'user_id' => $user1->id,
            'travel_schedule_id' => $schedule1->id,
            'status' => 'pending',
        ]);

        // Membuat booking untuk penumpang kedua
        $user2 = User::where('email', 'customer2@example.com')->first();
        $schedule2 = TravelSchedule::where('destination', 'Yogyakarta')->first();

        Booking::create([
            'user_id' => $user2->id,
            'travel_schedule_id' => $schedule2->id,
            'status' => 'confirmed',
        ]);
    }
}
