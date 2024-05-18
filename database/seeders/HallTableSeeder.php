<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Hall::factory()->create([
           'description'=>'hall1',
           'row'=>4,
           'seat'=>7,
       ]);
       Hall::factory()->create([
            'description'=>'hall2',
            'row'=>8,
            'seat'=>10,
        ]);
    }
}
