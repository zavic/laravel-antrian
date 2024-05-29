<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '082320855591',
            'role' => 'ADMIN'
        ]);
        // User::factory()->create([
        //     'name' => 'Staff',
        //     'email' => 'staff@gmail.com',
        //     'phone' => '082320855592',
        //     'role' => 'STAFF'
        // ]);
        // User::factory()->create([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'phone' => '082320855593',
        //     'role' => 'USER'
        // ]);

        // $this->call(QueueSeeder::class);
        $this->call(SettingSeeder::class);

        $this->call(QueueLoketSeeder::class);

    }
}
