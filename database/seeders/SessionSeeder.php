<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Почистимо дані в таблиці перед заповненням

        Session::class::factory()->create([
            'movie_id' => 1,
            'hall_number' => 2,
            'start_time' => '17:00:00',
            'date_of_session' => '2024-05-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Session::class::factory()->create([
            'movie_id' => 2,
            'hall_number' => 2,
            'start_time' => '18:00:00',
            'date_of_session' => '2024-05-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Session::class::factory()->create([
            'movie_id' => 3,
            'hall_number' => 1,
            'start_time' => '16:00:00',
            'date_of_session' => '2024-05-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
