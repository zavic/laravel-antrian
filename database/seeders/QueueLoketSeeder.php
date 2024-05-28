<?php

namespace Database\Seeders;

use App\Models\QueueLoket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QueueLoketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QueueLoket::create([
            'loket_number' => 1,
            'name' => '1'
        ]);
    }
}
